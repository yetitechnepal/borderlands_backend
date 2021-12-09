<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Banner;
use App\Models\Testimonial;
use App\Models\Video;
use App\Models\Company;
use App\Models\Package;
use App\Models\Quickdate;
use App\Models\Service;
use App\Models\Booking;
use App\Models\Offer;
use App\Models\Packageinclude;
class AdminController extends Controller
{
    public function index(){
        $count = [
            'TodayBookingCount'=>Booking::whereRaw('Date(stdate) = CURDATE()')->count(),
            'TodayEnquiryCount'=>Booking::whereRaw('Date(created_at) = CURDATE()')->count(),
        ];
        return view('bac.dashboard.index',$count);
    }

    public function getBanner(){
        return view('bac.banner.index')->with('banners', Banner::orderBy('updated_at','Desc')->get());
    }

    public function addBanner(Request $request){
        $banner = new Banner;
        $banner->title = $request->title;
        $banner->desc = $request->desc;
        $banner->subTitle = $request->subTitle;
        $destinationPath = public_path('images'); // upload path
        if ($files = $request->file('bannerImage')) {
            // Define upload path
         // Upload Orginal Image           
            $logo = date('YmdHis') . "." . $files->getClientOriginalExtension();
            $files->move($destinationPath, $logo);
 
         // Save In Database
            $banner->bannerImage =$logo;
         }
        $save = $banner->save();
        if($save){
            return back()->with('success','Banner Added');
        }else{
            return back()->with('fail','Something went wrong, try again later');
        }
    }

    public function saveBanner(Request $request){
        $banner = Banner::find($request->id);
        $banner->title = $request->title;
        $banner->desc = $request->desc;
        $banner->subTitle = $request->subTitle;
        $destinationPath = public_path('images'); // upload path
        if ($files = $request->file('bannerImage')) {
            // Define upload path
         // Upload Orginal Image           
            $logo = date('YmdHis') . "." . $files->getClientOriginalExtension();
            $files->move($destinationPath, $logo);
 
         // Save In Database
            $banner->bannerImage =$logo;
         }
        $save = $banner->save();
        if($save){
            return back()->with('success','Banner Updated');
        }else{
            return back()->with('fail','Something went wrong, try again later');
        }
    }

    public function bannerDestroy(Request $request){
        $banner = Banner::findOrFail($request->id);
        $banner->delete();
        return back()->with('success','Banner deleted');
    }

    public function getTestimonials(){
        return view('bac.testimonials.index')->with('testimonials', Testimonial::orderBy('updated_at','Desc')->get());
    }

    public function testimonialsDestroy(Request $request){
        $testimonials = Testimonial::findOrFail($request->id);
        $testimonials->delete();
        return back()->with('success','Testimonial deleted');
    }

    public function addTestimonial(Request $request){
        $testimonial = new Testimonial;
        $testimonial->name = $request->name;
        $testimonial->message = $request->message;
        $destinationPath = public_path('images'); // upload path
        if ($files = $request->file('image')) {
            // Define upload path
         // Upload Orginal Image           
            $logo = date('YmdHis') . "." . $files->getClientOriginalExtension();
            $files->move($destinationPath, $logo);
 
         // Save In Database
            $testimonial->image =$logo;
         }
        $save = $testimonial->save();
        if($save){
            return back()->with('success','Testimonials Added');
        }else{
            return back()->with('fail','Something went wrong, try again later');
        }
    }

    public function saveTestimonial(Request $request){
        $testimonial = Testimonial::findOrFail($request->id);
        $testimonial->name = $request->name;
        $testimonial->message = $request->message;
        $destinationPath = public_path('images'); // upload path
        if ($files = $request->file('image')) {
            // Define upload path
         // Upload Orginal Image           
            $logo = date('YmdHis') . "." . $files->getClientOriginalExtension();
            $files->move($destinationPath, $logo);
 
         // Save In Database
            $testimonial->image =$logo;
         }
        $save = $testimonial->save();
        if($save){
            return back()->with('success','Testimonials Saved');
        }else{
            return back()->with('fail','Something went wrong, try again later');
        }
    }

    public function getVideos(){
        return view('bac.video.index')->with('videos', Video::orderBy('updated_at','Desc')->get());
    }

    public function videosDestroy(Request $request){
        $videos = Video::findOrFail($request->id);
        $videos->delete();
        return back()->with('success','Video deleted');
    }

    public function addVideo(Request $request){
        $video = new Video;
        $video->title = $request->title;
        $video->link = $request->link;
        
        $destinationPath = public_path('images'); // upload path
        if ($files = $request->file('thumbnail')) {
            // Define upload path
         // Upload Orginal Image           
            $logo = date('YmdHis') . "." . $files->getClientOriginalExtension();
            $files->move($destinationPath, $logo);
 
         // Save In Database
            $video->thumbnail =$logo;
         }

        $save = $video->save();
        if($save){
            return back()->with('success','Videos Added');
        }else{
            return back()->with('fail','Something went wrong, try again later');
        }
    }

    public function saveVideo(Request $request){
        $video = Video::findOrFail($request->id);
        $video->title = $request->title;
        $video->link = $request->link;
        $destinationPath = public_path('images'); // upload path
        if ($files = $request->file('thumbnail')) {
            // Define upload path
         // Upload Orginal Image           
            $logo = date('YmdHis') . "." . $files->getClientOriginalExtension();
            $files->move($destinationPath, $logo);
 
         // Save In Database
            $video->thumbnail =$logo;
         }
        
        $save = $video->save();
        if($save){
            return back()->with('success','Video Saved');
        }else{
            return back()->with('fail','Something went wrong, try again later');
        }
    }

    public function getCompanies(){
        return view('bac.company.index')->with('companies', Company::orderBy('updated_at','Desc')->where('status','=','active')->get());
    }

    // public function companyDestroy(Request $request){
    //     $company = Company::findOrFail($request->id);
    //     $company->delete();
    //     return back()->with('success','Company deleted');
    // }

    public function addCompany(Request $request){
        $company = new Company;
        $company->companyName = $request->companyName;
        $company->companyAbout = $request->companyAbout;
        $company->companyStar = $request->companyStar;
        $company->companyAddress = $request->companyAddress;
        $company->companyPhone1 = $request->companyPhone1;
        $company->companyPhone2 = $request->companyPhone2;
        $company->companyEmail = $request->companyEmail;
        $company->websiteURL = $request->websiteURL;
        $company->facebookURL = $request->facebookURL;
        $company->instaURL = $request->instaURL;

        $destinationPath = public_path('images'); // upload path
        if ($files = $request->file('bannerImage')) {
            // Define upload path
         // Upload Orginal Image           
            $logo = date('YmdHis') . "." . $files->getClientOriginalExtension();
            $files->move($destinationPath, $logo);
 
         // Save In Database
            $company->bannerImage =$logo;
         }
        $save = $company->save();
        if($save){
            return back()->with('success','Company Added');
        }else{
            return back()->with('fail','Something went wrong, try again later');
        }
    }

    public function saveCompany(Request $request){
        $company = Company::findOrFail($request->id);
        $company->companyName = $request->companyName;
        $company->companyAbout = $request->companyAbout;
        $company->companyStar = $request->companyStar;
        $company->companyAddress = $request->companyAddress;
        $company->companyPhone1 = $request->companyPhone1;
        $company->companyPhone2 = $request->companyPhone2;
        $company->companyEmail = $request->companyEmail;
        $company->websiteURL = $request->websiteURL;
        $company->facebookURL = $request->facebookURL;
        $company->instaURL = $request->instaURL;

        $destinationPath = public_path('images'); // upload path
        if ($files = $request->file('bannerImage')) {
            // Define upload path
         // Upload Orginal Image           
            $logo = date('YmdHis') . "." . $files->getClientOriginalExtension();
            $files->move($destinationPath, $logo);
 
         // Save In Database
            $company->bannerImage =$logo;
         }
        $save = $company->save();
        if($save){
            return back()->with('success','Company Saved');
        }else{
            return back()->with('fail','Something went wrong, try again later');
        }
    }

    public function getCompanyDetail($id){
        $company = ['CompanyInfo'=>Company::orderBy('updated_at','Desc')
        ->where('id','=',$id)    
        ->first()];
        return view('bac.company.companyDetail',$company)
        ->with('services', Service::where('companies_id','=',$id)->orderBy('updated_at','Desc')->get());
    }

    public function companyDestroy(Request $request){
        $service = Company::findOrFail($request->id);
        $service->status = 'deleted';
        $save = $service->save();
        if($save){
            return back()->with('success','deleted');
        }else{
            return back()->with('fail','Something went wrong, try again later');
        }
    }

    public function addService(Request $request){
        $service = new Service;
        $service->title = $request->title;
        $service->companies_id = $request->id;

        $destinationPath = public_path('images'); // upload path
        if ($files = $request->file('image')) {
            // Define upload path
         // Upload Orginal Image           
            $logo = date('YmdHis') . "." . $files->getClientOriginalExtension();
            $files->move($destinationPath, $logo);
 
         // Save In Database
            $service->image =$logo;
         }
        $save = $service->save();
        if($save){
            return back()->with('success','Service Added');
        }else{
            return back()->with('fail','Something went wrong, try again later');
        }
    }

    public function saveService(Request $request){
        $service = Service::findOrFail($request->id);
        $service->title = $request->title;

        $destinationPath = public_path('images'); // upload path
        if ($files = $request->file('image')) {
            // Define upload path
         // Upload Orginal Image           
            $logo = date('YmdHis') . "." . $files->getClientOriginalExtension();
            $files->move($destinationPath, $logo);
 
         // Save In Database
            $service->image =$logo;
         }
        $save = $service->save();
        if($save){
            return back()->with('success','Service Saved');
        }else{
            return back()->with('fail','Something went wrong, try again later');
        }
    }

    public function serviceDestroy(Request $request){
        $service = Service::findOrFail($request->id);
        $service->delete();
        return back()->with('success','service deleted');
    }

    public function getPackages($id){
        $company = ['CompanyInfo'=>Company::orderBy('updated_at','Desc')
        ->where('id','=',$id)    
        ->first()];
        return view('bac.package.index',$company)
        ->with('packages', Package::where('companies_id','=',$id)->orderBy('updated_at','Desc')->get());
    }

    public function addPackages(Request $request){
        $package = new Package;
        $package->title = $request->title;
        $package->subtitle = $request->subtitle;
        $package->aboutPackage = $request->aboutPackage;
        $package->rating = $request->rating;
        $package->Duration = $request->Duration;
        $package->hotdeals = empty($request->hotdeals)?0:1;
        $package->featured = empty($request->featured)?0:1;
        $package->mostpopular = empty($request->mostpopular)?0:1;
        $package->topdeals = empty($request->topdeals)?0:1;
        $package->highlights = empty($request->highlights)?0:1;
        $package->trending = empty($request->trending)?0:1;
        $package->companies_id = $request->id;

        $destinationPath = public_path('images'); // upload path
        if ($files = $request->file('coverImage')) {
            // Define upload path
         // Upload Orginal Image           
            $logo = date('YmdHis') . "." . $files->getClientOriginalExtension();
            $files->move($destinationPath, $logo);
 
         // Save In Database
            $package->coverImage =$logo;
         }
        $save = $package->save();
        if($save){
            return back()->with('success','Package Added');
        }else{
            return back()->with('fail','Something went wrong, try again later');
        }
    }

    public function savePackages(Request $request){
        $package = Package::findOrFail($request->id);
        $package->title = $request->title;
        $package->subtitle = $request->subtitle;
        $package->aboutPackage = $request->aboutPackage;
        $package->rating = $request->rating;
        $package->Duration = $request->Duration;
        $package->hotdeals = empty($request->hotdeals)?0:1;
        $package->featured = empty($request->featured)?0:1;
        $package->mostpopular = empty($request->mostpopular)?0:1;
        $package->topdeals = empty($request->topdeals)?0:1;
        $package->highlights = empty($request->highlights)?0:1;
        $package->trending = empty($request->trending)?0:1;

        $destinationPath = public_path('images'); // upload path
        if ($files = $request->file('coverImage')) {
            // Define upload path
         // Upload Orginal Image           
            $logo = date('YmdHis') . "." . $files->getClientOriginalExtension();
            $files->move($destinationPath, $logo);
 
         // Save In Database
            $package->coverImage =$logo;
         }
        $save = $package->save();
        if($save){
            return back()->with('success','Package Added');
        }else{
            return back()->with('fail','Something went wrong, try again later');
        }
    }

    public function packageDestroy(Request $request){
        $package = Package::findOrFail($request->id);
        $package->delete();
        return back()->with('success','Package Deleted');
    }

    public function getQuickDates($id){
        $package = ['PackageInfo'=>Package::orderBy('updated_at','Desc')
        ->where('id','=',$id)    
        ->first()];
        return view('bac.package.quickdates',$package)
        ->with('quickdates', Quickdate::where('package_id','=',$id)->where('status','=',1)->orderBy('updated_at','Desc')->get());
    }

    public function addQuickdates(Request $request){
        $quickdate = new Quickdate;
        // $quickdate->quickdate = date("d-M-y", strtotime($request->quickdate));;
        $quickdate->stdate = $request->stdate;
        $quickdate->enddate = $request->enddate;
        $quickdate->rate = $request->rate;
        $quickdate->occupancy = "1";
        $quickdate->package_id = $request->id;

        $save = $quickdate->save();
        if($save){
            return back()->with('success','Quick Dates Added');
        }else{
            return back()->with('fail','Something went wrong, try again later');
        }

    }

    public function quickdatesDestroy(Request $request){
        $package = Quickdate::findOrFail($request->id);
        // $package->delete();
        $package->status = 0;
        $save = $package->save();
        if($save){
            return back()->with('success','Quick Dates Removed');
        }else{
            return back()->with('fail','Something went wrong, try again later');
        }
    }

    public function getWhatsIncluded($id){
        $package = ['PackageInfo'=>Package::orderBy('updated_at','Desc')
        ->where('id','=',$id)    
        ->first()];
        return view('bac.package.whatsincluded',$package)
        ->with('whatsincludeds', Packageinclude::where('package_id','=',$id)->orderBy('updated_at','Desc')->get());
    }

    public function addWhatsIncluded(Request $request){
        $whatsincluded = new Packageinclude;
        $whatsincluded->title = $request->title;
        $whatsincluded->description = $request->description;
        $whatsincluded->package_id = $request->id;
        $save = $whatsincluded->save();
        if($save){
            return back()->with('success','Added Successfully');
        }else{
            return back()->with('fail','Something went wrong, try again later');
        }
    }

    public function whatsincludedDestroy(Request $request){
        $package = Packageinclude::findOrFail($request->id);
        $package->delete();
        return back()->with('success','Quickdate Deleted');
    }

    public function getBookings(){
        return view('bac.booking.index')->with('bookings', 
            Booking::select('packages.title','companies.companyName','bookings.id','bookings.name','bookings.email','bookings.phone','bookings.status','bookings.noOfGuests','bookings.stdate','bookings.enddate','bookings.billedAmount','bookings.transctionId')
            ->join('packages','packages.id','=','bookings.package_id')
            ->join('companies','companies.id','=','packages.companies_id')
            ->where('bookings.status','=','pending')
            ->get()
        );
    }

    public function pastBookings(Request $request){
        return view('bac.booking.pastBookings')->with('bookings', 
            Booking::select('packages.title','companies.companyName','bookings.id','bookings.name','bookings.email','bookings.phone','bookings.status','bookings.noOfGuests','bookings.stdate','bookings.enddate','bookings.billedAmount','bookings.transctionId')
            ->join('packages','packages.id','=','bookings.package_id')
            ->join('companies','companies.id','=','packages.companies_id')
            ->where('bookings.status','<>','pending')
            ->get()
        );
    }

    public function saveBooking(Request $request){
        $booking = Booking::findOrFail($request->id);
        $booking->status = $request->status;
        $save = $booking->save();
        if($save){
            return back()->with('success','Updated');
        }else{
            return back()->with('fail','Something went wrong, try again later');
        }
    }

    public function getOffer(){
        return view('bac.offer.index')
        ->with('offers', 
            Offer::select('companies.companyName','offers.title','offers.image','offers.id')
            ->join('companies','companies.id','=','offers.companies_id')
            ->get()
        )
        ->with('companies',
            Company::all()
        );
    }

    public function offerDestroy(Request $request){
        $offer = Offer::findOrFail($request->id);
        $offer->delete();
        return back()->with('success','Testimonial deleted');
    }

    public function addOffer(Request $request){
        $offer = new Offer;
        $offer->title = $request->title;
        $offer->companies_id = $request->companies_id;
        $destinationPath = public_path('images'); // upload path
        if ($files = $request->file('image')) {
            // Define upload path
         // Upload Orginal Image           
            $logo = date('YmdHis') . "." . $files->getClientOriginalExtension();
            $files->move($destinationPath, $logo);
 
         // Save In Database
            $offer->image =$logo;
         }
        $save = $offer->save();
        if($save){
            return back()->with('success','Offers Added');
        }else{
            return back()->with('fail','Something went wrong, try again later');
        }
    }

    public function saveOffer(Request $request){
        $offer = Offer::findOrFail($request->id);
        $offer->title = $request->title;
        $offer->companies_id = $request->companies_id;
        $destinationPath = public_path('images'); // upload path
        if ($files = $request->file('image')) {
            // Define upload path
         // Upload Orginal Image           
            $logo = date('YmdHis') . "." . $files->getClientOriginalExtension();
            $files->move($destinationPath, $logo);
 
         // Save In Database
            $offer->image =$logo;
         }
        $save = $offer->save();
        if($save){
            return back()->with('success','Offers Saved');
        }else{
            return back()->with('fail','Something went wrong, try again later');
        }
    }

}