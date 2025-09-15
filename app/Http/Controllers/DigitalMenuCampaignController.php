<?php

namespace App\Http\Controllers;

use App\Http\Requests\DigitalMenuCampaignRequest;
use App\Http\Requests\DigitalMenuCategoryRequest;
use App\Models\DigitalMenuCampaign;
use App\Models\DigitalMenuCategory;
use Illuminate\Http\Request;
use Illuminate\Routing\Controllers\Middleware;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Encoders\JpegEncoder;
use Intervention\Image\Laravel\Facades\Image;
use Yajra\DataTables\DataTables;

class DigitalMenuCampaignController extends Controller
{
    public static function middleware(): array
    {
        return [
            new Middleware(['role:Sistem Yöneticisi'], only: ['index', 'create', 'store', 'edit', 'update', 'destroy']),
        ];
    }

    public function index(Request $request)
    {
        $data = DigitalMenuCampaign::where('linked_client_id', Auth::user()->linkedClient->id)->get();
        if ($request->ajax()) {
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('campaignName', function ($row_campaign_name) {
                    return $row_campaign_name->campaign_name;
                })
                ->addColumn('campaignDescription', function ($row_campaign_description) {
                    return $row_campaign_description->campaign_description;
                })
                ->addColumn('campaignStandardPrice', function ($row_campaign_price) {
                    return $row_campaign_price->campaign_standard_price;
                })
                ->addColumn('campaignDiscountedPrice', function ($row_campaign_old_price) {
                    return $row_campaign_old_price->campaign_discounted_price;
                })
                ->addColumn('campaignStatus', function ($row_standStatus) {
                    return ($row_standStatus->is_active) ? '<span class="badge rounded-pill badge-light-success">Aktif</span>' : '<span class="badge rounded-pill badge-light-danger">Pasif</span>';
                })
                ->rawColumns(['campaignName', 'campaignDescription', 'campaignStandardPrice', 'campaignDiscountedPrice', 'campaignStatus'])
                ->make(true);
        }

        return view('pages.digital_menu_campaigns.digital_menu_campaigns_index');
    }

    public function sortIndex()
    {
        $digitalMenuCampaigns = DigitalMenuCampaign::where('linked_client_id', Auth::user()->linkedClient->id)->orderBy('order')->get();
        return view('pages.digital_menu_campaigns.digital_menu_campaigns_sort', compact('digitalMenuCampaigns'));
    }

    public function sortUpdate(Request $request)
    {
        if ($request->input('order')) {
            $orderData = json_decode($request->input('order'), true);

            foreach ($orderData as $data) {
                DigitalMenuCampaign::where('id', $data['id'])->update(['order' => $data['order']]);
            }
        }

        return redirect()->route('DigitalMenuCampaigns.Sort.Index')
            ->with('result','warning')
            ->with('title', "İşlem Başarılı!")
            ->with('content', "Sıralama başarı ile güncellendi.");
    }


    public function create()
    {
        return view('pages.digital_menu_campaigns.digital_menu_campaigns_create');
    }

    public function store(DigitalMenuCampaignRequest $request)
    {
        $digitalMenuCampaign = new DigitalMenuCampaign();
        $digitalMenuCampaign->campaign_name = $request['input-campaign_name'];
        $digitalMenuCampaign->campaign_description = $request['input-campaign_description'];
        $digitalMenuCampaign->campaign_standard_price = $request['input-campaign_standard_price'];
        $digitalMenuCampaign->campaign_discounted_price = $request['input-campaign_discounted_price'];
        $digitalMenuCampaign->linked_client_id = Auth::user()->linkedClient->id;
        $digitalMenuCampaign->is_active = $request['input-is_active'];
        $digitalMenuCampaign->save();

        if ($request->hasFile('input-campaign_main_image')) {
            $campaignImage = $request->file('input-campaign_main_image');
            $campaignImageData = Image::read($campaignImage);

            $imageWidth = 400;
            $imageHeight = 300;
            $campaignImageData->scale(height: $imageHeight);
            $campaignImageData->crop($imageWidth, $imageHeight);

            $campaignImagePath = 'uploads/campaigns/'.Auth::user()->linkedClient->id.'/'.$digitalMenuCampaign->id;

            if (!Storage::disk('public')->exists($campaignImagePath)) {
                Storage::disk('public')->makeDirectory($campaignImagePath);
            }

            $campaignImageFileName = $digitalMenuCampaign->id.'.jpg';
            $campaignImageStoragePath = $campaignImagePath. '/'.$campaignImageFileName;
            Storage::disk('public')->put($campaignImageStoragePath, $campaignImageData->encode(new JpegEncoder(quality: 100)));
        }

        return redirect()->route('DigitalMenuCampaigns.Index')
            ->with('result','success')
            ->with('title', "İşlem Başarılı!")
            ->with('content', "Kayıt başarı ile sisteme eklendi.");
    }

    public function edit(string $id)
    {
        $digitalMenuCampaign = DigitalMenuCampaign::find($id);
        return view('pages.digital_menu_campaigns.digital_menu_campaigns_edit', compact('digitalMenuCampaign'));
    }

    public function update(DigitalMenuCampaignRequest $request, string $id)
    {
        $digitalMenuCampaign = DigitalMenuCampaign::find($id);
        $digitalMenuCampaign->campaign_name = $request['input-campaign_name'];
        $digitalMenuCampaign->campaign_description = $request['input-campaign_description'];
        $digitalMenuCampaign->campaign_standard_price = $request['input-campaign_standard_price'];
        $digitalMenuCampaign->campaign_discounted_price = $request['input-campaign_discounted_price'];
        $digitalMenuCampaign->linked_client_id = Auth::user()->linkedClient->id;
        $digitalMenuCampaign->is_active = $request['input-is_active'];
        $digitalMenuCampaign->save();

        if ($request->hasFile('input-campaign_main_image')) {
            $campaignImage = $request->file('input-campaign_main_image');
            $campaignImageData = Image::read($campaignImage);

            $imageWidth = 400;
            $imageHeight = 300;
            $campaignImageData->scale(height: $imageHeight);
            $campaignImageData->crop($imageWidth, $imageHeight);

            $campaignImagePath = 'uploads/campaigns/'.Auth::user()->linkedClient->id.'/'.$digitalMenuCampaign->id;

            if (!Storage::disk('public')->exists($campaignImagePath)) {
                Storage::disk('public')->makeDirectory($campaignImagePath);
            }

            $campaignImageFileName = $digitalMenuCampaign->id.'.jpg';
            $campaignImageStoragePath = $campaignImagePath. '/'.$campaignImageFileName;
            Storage::disk('public')->put($campaignImageStoragePath, $campaignImageData->encode(new JpegEncoder(quality: 100)));
        }

        return redirect()->route('DigitalMenuCampaigns.Edit', $id)
            ->with('result','warning')
            ->with('title', "İşlem Başarılı!")
            ->with('content', "Kayıt başarı ile güncellendi.");
    }

    public function destroy(string $id)
    {
        $stand = DigitalMenuCampaign::find($id);
        $stand->delete();

        return response()->json([
            'status' => 'danger',
            'title' => "İşlem Başarılı!",
            'message' => "Kayıt başarı ile sistemden silindi."
        ]);
    }

}
