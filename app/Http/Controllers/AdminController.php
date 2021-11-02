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

class AdminController extends Controller
{
    public function index(){
        return view('bac.dashboard.index');
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
        $video->thumbnail = '';
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
        $video->thumbnail = '';
        
        $save = $video->save();
        if($save){
            return back()->with('success','Video Saved');
        }else{
            return back()->with('fail','Something went wrong, try again later');
        }
    }

    public function getCompanies(){
        return view('bac.company.index')->with('companies', Company::orderBy('updated_at','Desc')->get());
    }

    public function companyDestroy(Request $request){
        $company = Company::findOrFail($request->id);
        $company->delete();
        return back()->with('success','Company deleted');
    }

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
        $package = Package::findOrFail($request->id);;
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
        ->with('quickdates', Quickdate::where('package_id','=',$id)->orderBy('updated_at','Desc')->get());
    }

    public function addQuickDates(Request $request){
        $quickdate = new Quickdate;
        $quickdate->title = $request->title;
    }

    public function getWhatsIncludes($id){
        $package = ['PackageInfo'=>Package::orderBy('updated_at','Desc')
        ->where('id','=',$id)    
        ->first()];
        return view('bac.package.index',$company)
        ->with('packages', Package::where('companies_id','=',$id)->orderBy('updated_at','Desc')->get());
    }
}