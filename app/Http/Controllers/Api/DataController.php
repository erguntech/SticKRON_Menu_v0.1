<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\MediaGallery;
use App\Models\News;
use App\Models\Popup;
use App\Models\Product;
use App\Models\ProductCategory;
use App\Models\Project;
use App\Models\ProjectCategory;
use App\Models\Reference;
use App\Models\Slider;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class DataController extends Controller
{
    public function getProductCategories(Request $request)
    {
        $user = User::where('email', $request->email)->first();
        $data = ProductCategory::where('client_id', $user->linkedClient->id)->where('is_active', true)->orderBy('order')->get();
        $collection = collect();

        foreach ($data as $dataItem) {
            $collection->add([
                'product_category_id' => $dataItem->id,
                'product_category_title' => $dataItem->category_title,
                'product_category_description' => $dataItem->category_description,
                'product_category_meta_title' => $dataItem->meta_title,
                'product_category_meta_tags' => $dataItem->meta_tags,
                'product_category_meta_description' => $dataItem->meta_description,
                'product_category_main_image_file' => Storage::url('uploads/productcategories/'.$user->linkedClient->id.'/'.$dataItem->id.'/'.$dataItem->id.'.jpg'),
            ]);
        }

        return response()->json([
            'dataPool' => $collection
        ],200);
    }

    public function getProducts(Request $request)
    {
        $user = User::where('email', $request->email)->first();
        $data = Product::where('client_id', $user->linkedClient->id)->where('product_category_id', $request->product_category_id)->where('is_active', true)->orderBy('order')->get();
        $collection = collect();

        foreach ($data as $dataItem) {
            $collection->add([
                'product_id' => $dataItem->id,
                'product_title' => $dataItem->product_title,
                'product_description' => $dataItem->product_description,
                'product_meta_title' => $dataItem->meta_title,
                'product_meta_tags' => $dataItem->meta_tags,
                'product_meta_description' => $dataItem->meta_description,
                'product_main_image_file' => Storage::url('uploads/products/'.$user->linkedClient->id.'/'.$dataItem->id.'/'.$dataItem->id.'.jpg'),
                'product_gallery_path' => Storage::url('uploads/products/'.$user->linkedClient->id.'/'.$dataItem->id.'/gallery'),
            ]);
        }

        return response()->json([
            'dataPool' => $collection
        ],200);
    }

    public function getProjectCategories(Request $request)
    {
        $user = User::where('email', $request->email)->first();
        $data = ProjectCategory::where('client_id', $user->linkedClient->id)->where('is_active', true)->orderBy('order')->get();
        $collection = collect();

        foreach ($data as $dataItem) {
            $collection->add([
                'project_category_id' => $dataItem->id,
                'project_category_title' => $dataItem->category_title,
                'project_category_description' => $dataItem->category_description,
                'project_category_meta_title' => $dataItem->meta_title,
                'project_category_meta_tags' => $dataItem->meta_tags,
                'project_category_meta_description' => $dataItem->meta_description,
                'project_category_main_image_file' => Storage::url('uploads/projectcategories/'.$user->linkedClient->id.'/'.$dataItem->id.'/'.$dataItem->id.'.jpg'),
            ]);
        }

        return response()->json([
            'dataPool' => $collection
        ],200);
    }

    public function getProjects(Request $request)
    {
        $user = User::where('email', $request->email)->first();
        $data = Project::where('client_id', $user->linkedClient->id)->where('project_category_id', $request->project_category_id)->where('is_active', true)->orderBy('order')->get();
        $collection = collect();

        foreach ($data as $dataItem) {
            $collection->add([
                'project_id' => $dataItem->id,
                'project_title' => $dataItem->project_title,
                'project_description' => $dataItem->project_description,
                'project_meta_title' => $dataItem->meta_title,
                'project_meta_tags' => $dataItem->meta_tags,
                'project_meta_description' => $dataItem->meta_description,
                'project_main_image_file' => Storage::url('uploads/projects/'.$user->linkedClient->id.'/'.$dataItem->id.'/'.$dataItem->id.'.jpg'),
                'project_gallery_path' => Storage::url('uploads/projects/'.$user->linkedClient->id.'/'.$dataItem->id.'/gallery'),
            ]);
        }

        return response()->json([
            'dataPool' => $collection
        ],200);
    }

    public function getSliders(Request $request)
    {
        $user = User::where('email', $request->email)->first();
        $data = Slider::where('client_id', $user->linkedClient->id)->where('is_active', true)->orderBy('order')->get();
        $collection = collect();

        foreach ($data as $dataItem) {
            $collection->add([
                'id' => $dataItem->id,
                'slider_title' => $dataItem->slider_title,
                'slider_description' => $dataItem->slider_description,
                'slider_main_image_file' => Storage::url('uploads/sliders/'.$user->linkedClient->id.'/'.$dataItem->id.'/'.$dataItem->id.'.jpg'),
            ]);
        }

        return response()->json([
            'dataPool' => $collection
        ],200);
    }

    public function getMediaGalleries(Request $request)
    {
        $user = User::where('email', $request->email)->first();
        $data = MediaGallery::where('client_id', $user->linkedClient->id)->where('is_active', true)->orderBy('order')->get();
        $collection = collect();

        foreach ($data as $dataItem) {
            $collection->add([
                'media_gallery_id' => $dataItem->id,
                'media_gallery_title' => $dataItem->media_gallery_title,
                'media_gallery_meta_title' => $dataItem->meta_title,
                'media_gallery_meta_tags' => $dataItem->meta_tags,
                'media_gallery_meta_description' => $dataItem->meta_description,
                'media_gallery_gallery_path' => Storage::url('uploads/mediagalleries/'.$user->linkedClient->id.'/'.$dataItem->id.'/gallery'),
            ]);
        }

        return response()->json([
            'dataPool' => $collection
        ],200);
    }

    public function getNews(Request $request): JsonResponse
    {
        $user = User::where('email', $request->email)->first();
        $data = News::where('client_id', $user->linkedClient->id)->where('is_active', true)->orderBy('order')->get();
        $collection = collect();

        foreach ($data as $dataItem) {
            $collection->add([
                'id' => $dataItem->id,
                'news_title' => $dataItem->news_title,
                'news_content' => $dataItem->news_content,
                'news_meta_title' => $dataItem->meta_title,
                'news_meta_tags' => $dataItem->meta_tags,
                'news_meta_description' => $dataItem->meta_description,
                'news_main_image_file' => Storage::url('uploads/news/'.$user->linkedClient->id.'/'.$dataItem->id.'/'.$dataItem->id.'.jpg'),
                'news_gallery_path' => Storage::url('uploads/news/'.$user->linkedClient->id.'/'.$dataItem->id.'/gallery'),
            ]);
        }

        return response()->json([
            'dataPool' => $collection
        ], 200);
    }

    public function getReferences(Request $request)
    {
        $user = User::where('email', $request->email)->first();
        $data = Reference::where('client_id', $user->linkedClient->id)->where('is_active', true)->orderBy('order')->get();
        $collection = collect();

        foreach ($data as $dataItem) {
            $collection->add([
                'id' => $dataItem->id,
                'reference_title' => $dataItem->reference_title,
                'reference_description' => $dataItem->reference_description,
                'reference_main_image_file' => Storage::url('uploads/references/'.$user->linkedClient->id.'/'.$dataItem->id.'.jpg'),
            ]);
        }

        return response()->json([
            'dataPool' => $collection
        ],200);
    }

    public function getPopup(Request $request)
    {
        $user = User::where('email', $request->email)->first();
        $data = Popup::where('client_id', $user->linkedClient->id)->first();
        $collection = collect();

        $collection->add([
            'id' => $data->id,
            'status' => $data->is_active,
            'popup_title' => $data->popup_title,
            'popup_description' => $data->popup_description,
            'popup_main_image_file' => Storage::url('uploads/popups/'.$user->linkedClient->id.'.jpg'),
        ]);

        return response()->json([
            'dataPool' => $collection
        ],200);
    }
}
