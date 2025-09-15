<?php

namespace App\Http\Controllers;

use App\Http\Requests\DigitalMenuContentRequest;
use App\Models\DigitalMenuCategory;
use App\Models\DigitalMenuContent;
use Illuminate\Http\Request;
use Illuminate\Routing\Controllers\Middleware;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Encoders\JpegEncoder;
use Intervention\Image\Laravel\Facades\Image;
use Yajra\DataTables\DataTables;

class DigitalMenuContentController extends Controller
{
    public static function middleware(): array
    {
        return [
            new Middleware(['role:Sistem Yöneticisi'], only: ['index', 'create', 'store', 'edit', 'update', 'destroy']),
        ];
    }

    public function index(Request $request)
    {
        $data = DigitalMenuContent::where('linked_client_id', Auth::user()->linkedClient->id)->get();
        if ($request->ajax()) {
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('contentName', function ($row_content_name) {
                    return $row_content_name->content_name;
                })
                ->addColumn('contentDescription', function ($row_content_description) {
                    return $row_content_description->content_description;
                })
                ->addColumn('contentPrice', function ($row_content_price) {
                    return $row_content_price->content_price;
                })
                ->addColumn('linkedCategoryName', function ($row_linked_category_id) {
                    return '<span class="badge rounded-pill badge-light-primary">'.$row_linked_category_id->linkedDigitalMenuCategory->category_name.'</span>';
                })
                ->addColumn('contentStatus', function ($row_standStatus) {
                    return ($row_standStatus->is_active) ? '<span class="badge rounded-pill badge-light-success">Aktif</span>' : '<span class="badge rounded-pill badge-light-danger">Pasif</span>';
                })
                ->rawColumns(['contentName', 'contentDescription', 'contentPrice', 'linkedCategoryName', 'contentStatus'])
                ->make(true);
        }

        return view('pages.digital_menu_contents.digital_menu_contents_index');
    }

    public function sortIndex()
    {
        $digitalMenuContents = DigitalMenuContent::where('linked_client_id', Auth::user()->linkedClient->id)->orderBy('order')->get();
        return view('pages.digital_menu_contents.digital_menu_contents_sort', compact('digitalMenuContents'));
    }

    public function sortUpdate(Request $request)
    {
        if ($request->input('order')) {
            $orderData = json_decode($request->input('order'), true);

            foreach ($orderData as $data) {
                DigitalMenuContent::where('id', $data['id'])->update(['order' => $data['order']]);
            }
        }

        return redirect()->route('DigitalMenuContents.Sort.Index')
            ->with('result','warning')
            ->with('title', "İşlem Başarılı!")
            ->with('content', "Sıralama başarı ile güncellendi.");
    }

    public function create()
    {
        $digitalMenuCategories = DigitalMenuCategory::where('linked_client_id', Auth::user()->linkedClient->id)->where('is_active', true)->get();
        return view('pages.digital_menu_contents.digital_menu_contents_create', compact('digitalMenuCategories'));
    }

    public function store(DigitalMenuContentRequest $request)
    {
        $digitalMenuContent = new DigitalMenuContent();
        $digitalMenuContent->content_name = $request['input-content_name'];
        $digitalMenuContent->content_description = $request['input-content_description'];
        $digitalMenuContent->content_price = $request['input-content_price'];
        $digitalMenuContent->linked_digital_menu_category_id = $request['input-digital_menu_category_id'];
        $digitalMenuContent->linked_client_id = Auth::user()->linkedClient->id;
        $digitalMenuContent->is_active = $request['input-is_active'];
        $digitalMenuContent->save();

        if ($request->hasFile('input-product_main_image')) {
            $productImage = $request->file('input-product_main_image');
            $productImageData = Image::read($productImage);

            $imageWidth = 500;
            $imageHeight = 500;
            $productImageData->scale(height: $imageHeight);
            $productImageData->crop($imageWidth, $imageHeight);

            $productImagePath = 'uploads/products/'.Auth::user()->linkedClient->id.'/'.$digitalMenuContent->id;

            if (!Storage::disk('public')->exists($productImagePath)) {
                Storage::disk('public')->makeDirectory($productImagePath);
            }

            $productImageFileName = $digitalMenuContent->id.'.jpg';
            $productImageStoragePath = $productImagePath. '/'.$productImageFileName;
            Storage::disk('public')->put($productImageStoragePath, $productImageData->encode(new JpegEncoder(quality: 100)));
        }

        return redirect()->route('DigitalMenuContents.Index')
            ->with('result','success')
            ->with('title', "İşlem Başarılı!")
            ->with('content', "Kayıt başarı ile sisteme eklendi.");
    }

    public function edit(string $id)
    {
        $digitalMenuContent = DigitalMenuContent::find($id);
        $digitalMenuCategories = DigitalMenuCategory::where('linked_client_id', Auth::user()->linkedClient->id)->where('is_active', true)->get();
        return view('pages.digital_menu_contents.digital_menu_contents_edit', compact('digitalMenuContent', 'digitalMenuCategories'));
    }

    public function update(DigitalMenuContentRequest $request, string $id)
    {
        $digitalMenuContent = DigitalMenuContent::find($id);
        $digitalMenuContent->content_name = $request['input-content_name'];
        $digitalMenuContent->content_description = $request['input-content_description'];
        $digitalMenuContent->content_price = $request['input-content_price'];
        $digitalMenuContent->linked_digital_menu_category_id = $request['input-digital_menu_category_id'];
        $digitalMenuContent->linked_client_id = Auth::user()->linkedClient->id;
        $digitalMenuContent->is_active = $request['input-is_active'];
        $digitalMenuContent->save();

        if ($request->hasFile('input-product_main_image')) {
            $productImage = $request->file('input-product_main_image');
            $productImageData = Image::read($productImage);

            $imageWidth = 500;
            $imageHeight = 500;
            $productImageData->scale(height: $imageHeight);
            $productImageData->crop($imageWidth, $imageHeight);

            $productImagePath = 'uploads/products/'.Auth::user()->linkedClient->id.'/'.$digitalMenuContent->id;

            if (!Storage::disk('public')->exists($productImagePath)) {
                Storage::disk('public')->makeDirectory($productImagePath);
            }

            $productImageFileName = $digitalMenuContent->id.'.jpg';
            $productImageStoragePath = $productImagePath. '/'.$productImageFileName;
            Storage::disk('public')->put($productImageStoragePath, $productImageData->encode(new JpegEncoder(quality: 100)));
        }

        return redirect()->route('DigitalMenuContents.Edit', $id)
            ->with('result','warning')
            ->with('title', "İşlem Başarılı!")
            ->with('content', "Kayıt başarı ile güncellendi.");
    }

    public function destroy(string $id)
    {
        $stand = DigitalMenuContent::find($id);
        $stand->delete();

        return response()->json([
            'status' => 'danger',
            'title' => "İşlem Başarılı!",
            'message' => "Kayıt başarı ile sistemden silindi."
        ]);
    }
}
