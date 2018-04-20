<?php


namespace App\Http\Controllers;


use Illuminate\Http\Request;


class ImageController extends Controller
{
    /**
     * success response method.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
    	return view('image-view');
    }


    /**
     * success response method.
     *
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
    	$imageName = request()->file->getClientOriginalName();
        request()->file->move(public_path('upload'), $imageName);

    	return response()->json(['uploaded' => '/upload/'.$imageName]);
    }


    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function imageCrop()
    {
        return view('ImageCrop');
    }


    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function imageCropPost(Request $request)
    {
        $data = $request->image;


        list($type, $data) = explode(';', $data);
        list(, $data)      = explode(',', $data);


        $data = base64_decode($data);
        $image_name= time().'.png';
        $path = public_path() . "/upload/" . $image_name;


        file_put_contents($path, $data);


        return response()->json(['success'=>'done']);
    }
}