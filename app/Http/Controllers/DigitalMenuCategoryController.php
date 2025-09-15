<?php

namespace App\Http\Controllers;

use App\Http\Requests\DigitalMenuCategoryRequest;
use App\Models\DigitalMenuCategory;
use App\Models\DigitalMenuContent;
use Illuminate\Http\Request;
use Illuminate\Routing\Controllers\Middleware;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\DataTables;

class DigitalMenuCategoryController extends Controller
{
    public static function middleware(): array
    {
        return [
            new Middleware(['role:Sistem Yöneticisi'], only: ['index', 'create', 'store', 'edit', 'update', 'destroy']),
        ];
    }

    public function index(Request $request)
    {
        if (Auth::user()->user_type == 1) {
            $data = DigitalMenuCategory::all();
        } else {
            $data = DigitalMenuCategory::where('linked_client_id', Auth::user()->linkedClient->id)->get();
        }

        if ($request->ajax()) {
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('categoryName', function ($row_category_name) {
                    return $row_category_name->category_name;
                })
                ->addColumn('categoryDescription', function ($row_category_description) {
                    return $row_category_description->category_description;
                })
                ->addColumn('categoryStatus', function ($row_standStatus) {
                    return ($row_standStatus->is_active) ? '<span class="badge rounded-pill badge-light-success">Aktif</span>' : '<span class="badge rounded-pill badge-light-danger">Pasif</span>';
                })
                ->rawColumns(['categoryName', 'categoryDescription', 'categoryStatus'])
                ->make(true);
        }

        return view('pages.digital_menu_categories.digital_menu_categories_index');
    }

    public function sortIndex()
    {
        $digitalMenuCategories = DigitalMenuCategory::where('linked_client_id', Auth::user()->linkedClient->id)->orderBy('order')->get();
        return view('pages.digital_menu_categories.digital_menu_categories_sort', compact('digitalMenuCategories'));
    }

    public function sortUpdate(Request $request)
    {
        if ($request->input('order')) {
            $orderData = json_decode($request->input('order'), true);

            foreach ($orderData as $data) {
                DigitalMenuCategory::where('id', $data['id'])->update(['order' => $data['order']]);
            }
        }

        return redirect()->route('DigitalMenuCategories.Sort.Index')
            ->with('result','warning')
            ->with('title', "İşlem Başarılı!")
            ->with('content', "Sıralama başarı ile güncellendi.");
    }

    public function create()
    {
        return view('pages.digital_menu_categories.digital_menu_categories_create');
    }

    public function store(DigitalMenuCategoryRequest $request)
    {
        $digitalMenuCategory = new DigitalMenuCategory();
        $digitalMenuCategory->category_name = $request['input-category_name'];
        $digitalMenuCategory->category_description = $request['input-category_description'];
        $digitalMenuCategory->linked_client_id = Auth::user()->linkedClient->id;
        $digitalMenuCategory->is_active = $request['input-is_active'];
        $digitalMenuCategory->save();

        return redirect()->route('DigitalMenuCategories.Index')
            ->with('result','success')
            ->with('title', "İşlem Başarılı!")
            ->with('content', "Kayıt başarı ile sisteme eklendi.");
    }

    public function edit(string $id)
    {
        $digitalMenuCategory = DigitalMenuCategory::find($id);
        return view('pages.digital_menu_categories.digital_menu_categories_edit', compact('digitalMenuCategory'));
    }

    public function update(DigitalMenuCategoryRequest $request, string $id)
    {
        $digitalMenuCategory = DigitalMenuCategory::find($id);
        $digitalMenuCategory->category_name = $request['input-category_name'];
        $digitalMenuCategory->category_description = $request['input-category_description'];
        $digitalMenuCategory->linked_client_id = Auth::user()->linkedClient->id;
        $digitalMenuCategory->is_active = $request['input-is_active'];
        $digitalMenuCategory->save();

        return redirect()->route('DigitalMenuCategories.Edit', $id)
            ->with('result','warning')
            ->with('title', "İşlem Başarılı!")
            ->with('content', "Kayıt başarı ile güncellendi.");
    }

    public function destroy(string $id)
    {
        $stand = DigitalMenuCategory::find($id);
        $stand->delete();

        return response()->json([
            'status' => 'danger',
            'title' => "İşlem Başarılı!",
            'message' => "Kayıt başarı ile sistemden silindi."
        ]);
    }
}
