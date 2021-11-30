<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\OrderShipped;
use App\Models\Banner;
use App\Models\Company;
use App\Models\Testimonial;
use App\Models\Package;
use App\Models\Service;
use App\Models\Packageinclude;
use App\Models\Photo;
use App\Models\Video;
use App\Models\Booking;
use App\Models\Event;
use App\Models\Quickdate;
use App\Models\Code;
use App\Models\Payment;
use App\Models\Offer;
use Illuminate\Support\Str;


 /**
 * @OA\GET(
 * path="/getBanners",
 * summary="Get Home Banner",
 * description="get Home Banner",
 * operationId="authLogin",
 * tags={"Banner"},
 * @OA\RequestBody(
 *    required=true,
 *    description="Pass user credentials",
 *    @OA\JsonContent(
 *       required={"email","password"},
 *       @OA\Property(property="email", type="string", format="email", example="user1@mail.com"),
 *       @OA\Property(property="password", type="string", format="password", example="PassWord12345"),
 *       @OA\Property(property="persistent", type="boolean", example="true"),
 *    ),
 * ),
 * @OA\Response(
 *    response=422,
 *    description="Wrong credentials response",
 *    @OA\JsonContent(
 *       @OA\Property(property="message", type="string", example="Sorry, wrong email address or password. Please try again")
 *        )
 *     )
 * )
 */ 

class HomeController extends Controller
{
    
    public function getBanners(){
        return ['message'=>'success','data'=>Banner::get()]; 
    }

    public function getTestimonials(){
        return ['message'=>'success','data'=>Testimonial::get()]; 
    }

    public function getCompanies($id){
        if($id == 'all'){
            return ['message'=>'success','data'=>Company::get()]; 
        }
        else{
            $data =  ['company'=>Company::
                where('id','=',$id)
                ->get()
            ,'services'=>Service::
            where('companies_id','=',$id)
            ->get()];

            return ['message'=>'success','data'=>$data];
            // return ['message'=>'success','data'=>Company::
            // join("services", "services.companies_id", "=", "companies.id")
            // ->where('companies.id','=',$id)
            // ->get()]; 
        }
    }

    public function getPackages($id,$type){
        if($type == 'recent'){
            return ['message'=>'success',
                'data'=>Package::limit(4)
                ->select('companies.companyName','packages.*')
                ->join("companies", "companies.id", "=", "packages.companies_id")
                ->where('packages.companies_id','=',$id)
                ->orderBy('packages.created_at','Desc')
                ->get()]; 
        }elseif($type == 'recentAll' && $id == 'all'){
            return ['message'=>'success',
                'data'=>Package::limit(6)
                ->select('packages.id','companies.companyName','packages.title','packages.coverImage')
                ->join("companies", "companies.id", "=", "packages.companies_id")
                ->orderBy('packages.created_at','Desc')
                ->get()];
        }
        elseif($type == 'all'){
            return ['message'=>'success',
                'data'=>Package::select('companies.companyName','packages.*')
                ->join("companies", "companies.id", "=", "packages.companies_id")
                ->where('packages.companies_id','=',$id)
                ->get()];
        }else{
            return ['message'=>'fail','data'=>'something went wrong!'];
        }
    }

    public function getPackageDetail($id){
        $data =  ['package'=>Package::
                    select('companies.companyName','packages.*')
                    ->join("companies", "companies.id", "=", "packages.companies_id")
                    ->where('packages.id','=',$id)
                    ->with('photos')
                    ->with('includes')
                    ->get()
                    ,
                    'quickdates'=> Quickdate::where('package_id','=',$id)->get()
                ];

        return ['message'=>'success',
                'data'=>$data]; 
    }

    public function getCompanyHotDeals($id){
        return ['message'=>'success',
                'data'=>Package::limit(4)
                ->where('companies_id','=',$id)
                ->where('hotdeals','=',1)
                ->orderBy('created_at','Desc')
                ->get()]; 
    }

    public function getHighLights(){

        $data =  ['package'=>Package::
                    select('companies.companyName','packages.*')
                    ->join("companies", "companies.id", "=", "packages.companies_id")
                    ->with('photos')
                    ->with('includes')
                    ->where('packages.highlights','=',1)
                    ->get()
                ];

        return ['message'=>'success',
                'data'=>$data]; 
    }

    public function getTopDeals(){
        $data =  ['monthsTopDeals'=>Package::
                    limit(8)
                    ->select('companies.companyName','packages.*')
                    ->join("companies", "companies.id", "=", "packages.companies_id")
                    ->where('packages.topdeals','=',1)
                    ->get()
                    ,
                    'featuredTopDeals'=>Package::
                    limit(8)
                    ->select('companies.companyName','packages.*')
                    ->join("companies", "companies.id", "=", "packages.companies_id")
                    ->where('packages.featured','=',1)
                    ->get()
                    ,
                    'mostpopular'=>Package::
                    limit(4)
                    ->select('companies.companyName','packages.*')
                    ->join("companies", "companies.id", "=", "packages.companies_id")
                    ->where('packages.mostpopular','=',1)
                    ->get()
                    ,
                    'trending'=>Package::
                    limit(4)
                    ->select('companies.companyName','packages.*')
                    ->join("companies", "companies.id", "=", "packages.companies_id")
                    ->where('packages.trending','=',1)
                    ->get()
                ];

            return ['message'=>'success','data'=>$data];
    }

    public function getExploreVideos(){

        $data =  ['exploreVideos'=>Video::get()
                ];

        return ['message'=>'success',
                'data'=>$data]; 
    }

    public function makeBooking(Request $request){
        // if($request->filled('transctionId')){

            if(!$request->filled('quickdate_id')){
                $quickdate = new Booking;
                $quickdate->name = $request->name;
                $quickdate->email = $request->email;
                $quickdate->phone = $request->phone;
                $quickdate->noOfGuests = $request->noOfGuests;
                $quickdate->stdate = $request->stdate;
                $quickdate->enddate = $request->enddate;
                $quickdate->transctionId = "Payment First Step";
                $quickdate->package_id = $request->package_id;
                $quickdate->uuid = Str::uuid()->toString();
                $save = $quickdate->save();
                if($save){
                    return ['message'=>'Sent for enquiry!'];
                }
                else{
                    return response(['message'=>'Error'], 400);
                }
            }

            $quick = Quickdate::where('id','=',$request->quickdate_id)->where('package_id','=',$request->package_id)->first();
            $package = Package::where('id','=',$request->package_id)->first();
            $company = Company::select('companyName','companyAddress','companyPhone1','companyEmail')->join('packages','packages.companies_id','=','companies.id')
            ->where('packages.id','=',$request->package_id)
            ->first();
            if($quick->rate*$request->noOfGuests == $request->billedAmount){
                $quickdate = new Booking;
                $quickdate->name = $request->name;
                $quickdate->email = $request->email;
                $quickdate->phone = $request->phone;
                $quickdate->noOfGuests = $request->noOfGuests;
                $quickdate->stdate = $request->stdate;
                $quickdate->enddate = $request->enddate;
                $quickdate->billedAmount = $request->billedAmount;
                $quickdate->transctionId = "Payment First Step";
                $quickdate->quickdate_id = $request->quickdate_id;
                $quickdate->package_id = $request->package_id;
                $quickdate->uuid = Str::uuid()->toString();

                $save = $quickdate->save();
                if($save){
                    // try {
                    //     Mail::to($request->email)->send(new OrderShipped($request,$package,$company,$quickdate,$quick));
                    return ['message'=>'Success',
                        'uuid'=>$quickdate->uuid];
                    // } catch (\Throwable $th) {
                    //     return ['message'=>'Order Success but email not sent!',
                    //     'orderDetails'=>$quickdate];
                    // }
                }else{
                    // $quickdate1 = new Booking;
                    // $quickdate1->transctionId = $request->transctionId;
                    // $quickdate1->save();
                    
                    return response(['message'=>'Error'], 400);
                }
                
            }else{
                $quickdate = new Booking;
                $quickdate->name = $request->name;
                $quickdate->email = $request->email;
                $quickdate->phone = $request->phone;
                $quickdate->noOfGuests = $request->noOfGuests;
                $quickdate->stdate = $request->stdate;
                $quickdate->enddate = $request->enddate;
                $quickdate->billedAmount = $request->billedAmount." - Actual Billing Amount: NPR ".$quick->rate*$request->noOfGuests;
                $quickdate->transctionId = "Payment First Step";
                $quickdate->quickdate_id = $request->quickdate_id;
                $quickdate->package_id = $request->package_id;
                $quickdate->uuid = Str::uuid()->toString();

                $save = $quickdate->save();
                if($save){
                    // try {
                    //     Mail::to($request->email)->send(new OrderShipped($request,$package,$company,$quickdate,$quick));
                    return ['message'=>'Order Success but amount didnot match',
                        'orderDetails'=>$quickdate->uuid];
                    // } catch (\Throwable $th) {
                    //     return ['message'=>'Order Success but email not sent!',
                    //     'orderDetails'=>$quickdate];
                    // }
                }else{
                    // $quickdate1 = new Booking;
                    // $quickdate1->transctionId = $request->transctionId;
                    // $quickdate1->save();
                    
                    return response(['message'=>'Error'], 400);
                }
            }
        // }else{

                // $quickdate = new Booking;
                // $quickdate->name = $request->name;
                // $quickdate->email = $request->email;
                // $quickdate->phone = $request->phone;
                // $quickdate->noOfGuests = $request->noOfGuests;
                // $quickdate->stdate = $request->stdate;
                // $quickdate->enddate = $request->enddate;
                // $quickdate->billedAmount = "0";
                // $quickdate->transctionId = "NO TRANSACTION ID";
                // $quickdate->quickdate_id = $request->quickdate_id;
                // $quickdate->package_id = $request->package_id;

                // $save = $quickdate->save();
                // if($save){
                //     return ['message'=>'Sent for Enquiry'];
                // }else{
                //     return back()->with('fail','Something went wrong, try again later! please contact service provider for more details!');
                // }
            
        // }
        
    }

    public function paymentSuccess(Request $request){
        if($request->filled('transactionID')){
            if(Payment::where('transactionID','=',$request->transactionID)->count() > 0){
                return response(['message'=>'Error! Dublicate Transaction ID'], 400);
            }else{
                $pay = new Payment;
                if($request->filled('order_id')){
                    $pay->order_id = $request->order_id;
                }else{
                    $pay->order_id = "Null";
                }
                
                $pay->transactionID = $request->transactionID;
                $save = $pay->save();

                $order = Booking::where('uuid','=',$request->order_id)->first();
                if($order===null){
                    return ['message'=>'couldnot find order. Transaction Saved!'];
                }
                else{
                    
                    $quick = Quickdate::where('id','=',$order->quickdate_id)->where('package_id','=',$order->package_id)->first();
                    $package = Package::where('id','=',$order->package_id)->first();
                    $company = Company::select('companyName','companyAddress','companyPhone1','companyEmail')->join('packages','packages.companies_id','=','companies.id')
                    ->where('packages.id','=',$order->package_id)
                    ->first();

                    if($order->transctionId == "Payment First Step"){
                        $order->transctionId =  $request->transactionID;
                        $order->save();
                        
                        try {
                            Mail::to($order->email)->send(new OrderShipped($order,$package,$company,$order,$quick));
                        } catch (\Throwable $th) {
                            //throw $th;
                        }
                        
                        if($save){
                            return ['message'=>'Success'];
                        }else{
                            return back()->with('fail','Something went wrong, try again later! please contact service provider for more details!');
                        }
                    }else{
                        return ['message'=>'Payment Was already Done for this order!'];
                    }
                    
                }
                
            }

        }else{
            return response(['message'=>'Error! Hasnot been paid yet'], 400);
        }
    }

    public function getEvents(){
 
         $a = Event::selectRaw('id,title as title,start,end,"Event" as type');
         $data = Quickdate::selectRaw('quickdates.id,CONCAT(packages.title," - NPR ",quickdates.rate)    as title,stdate as start,enddate as end,"Quick Date" as type')
         ->join('packages','packages.id','=','quickdates.package_id')
         ->union($a)
         ->get(['id','title','start', 'end']);

         return ['message'=>'success',
                        'data'=>$data];
    }

    public function getCodes(){
        $data =  Code::all();
        return ['message'=>'success',
                        'data'=>$data];
    }

    public function getWhatWeOffers(){
        $data =  Offer::
        select('companies.companyName','offers.title','offers.image')
        ->join('companies','companies.id','=','offers.companies_id')
        ->limit(6)->get();
        return ['message'=>'success',
                        'data'=>$data];
    }
}
