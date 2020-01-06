<?php

namespace App\Http\Controllers;


use App\Category;
use App\Contact_query;
use App\Country;
use App\Post;
use App\User;
use Illuminate\Http\Request;
use App\Http\Requests;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;


class HomeController extends Controller
{

    public function index(){

        try{
            DB::connection()->getPdo();
        }catch (\Exception $e){
            return $e->getMessage();
        }

        $current_country = currentCountry();

        $top_categories = Category::whereCategoryId(0)->with('sub_categories')->orderBy('category_name', 'asc')->get();
        $current_states = currentStates();

        $user_count = User::count();

        return view('homepage', compact('top_categories', 'current_states','user_count'));
    }

        public function home(){

        try{
            DB::connection()->getPdo();
        }catch (\Exception $e){
            return $e->getMessage();
        }

        $current_country = currentCountry();

        $top_categories = Category::whereCategoryId(0)->with('sub_categories')->orderBy('category_name', 'asc')->get();
        $current_states = currentStates();

        $user_count = User::count();

        return view('home', compact('top_categories', 'current_states','user_count'));
    }

    public function contactUs(){
        $title = trans('app.contact_us');
        return view('contact-us', compact('title'));
    }

    public function contactUsPost(Request $request){
        $rules = [
            'name'  => 'required',
            'email'  => 'required|email',
            'message'  => 'required',
        ];
        $this->validate($request, $rules);
        Contact_query::create(array_only($request->input(), ['name', 'email', 'message']));
        return redirect()->back()->with('success', trans('app.your_message_has_been_sent'));
    }

    public function contactMessages(){
        $title = trans('app.contact_messages');
        $contact_messages = Contact_query::orderBy('id', 'desc')->paginate(20);

        return view('admin.contact_messages', compact('title', 'contact_messages'));
    }

    public function contactUs1(){

        return view('contact-us');

    }

    public function aboutUs(){
        return view('about-us');
    }

    /**
     * Switch Language
     */
    public function switchLang($lang){
        session(['lang'=>$lang]);
        return back();
    }

    /**
     * Reset Database
     */
    public function resetDatabase(){
        $database_location = base_path("database-backup/classified.sql");
        // Temporary variable, used to store current query
        $templine = '';
        // Read in entire file
        $lines = file($database_location);
        // Loop through each line
        foreach ($lines as $line) {
            // Skip it if it's a comment
            if (substr($line, 0, 2) == '--' || $line == '')
                continue;
            // Add this line to the current segment
            $templine .= $line;
            // If it has a semicolon at the end, it's the end of the query
            if (substr(trim($line), -1, 1) == ';')
            {
                // Perform the query
                DB::statement($templine);
                // Reset temp variable to empty
                $templine = '';
            }
        }
        $now_time = date("Y-m-d H:m:s");
        DB::table('ads')->update(['created_at' => $now_time, 'updated_at' => $now_time]);
    }

    /**
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     *
     * Clear all cache
     */
    public function clearCache(){
        Artisan::call('debugbar:clear');
        Artisan::call('view:clear');
        Artisan::call('route:clear');
        Artisan::call('config:clear');
        Artisan::call('cache:clear');
        if (function_exists('exec')){
            exec('rm ' . storage_path('logs/*'));
        }
        $this->rrmdir(storage_path('logs/'));

        return redirect(route('home'));
    }
    public function rrmdir($dir) {
        if (is_dir($dir)) {
            $objects = scandir($dir);
            foreach ($objects as $object) {
                if ($object != "." && $object != "..") {
                    if (is_dir($dir."/".$object))
                        $this->rrmdir($dir."/".$object);
                    else
                        unlink($dir."/".$object);
                }
            }
            //rmdir($dir);
        }
    }




}
