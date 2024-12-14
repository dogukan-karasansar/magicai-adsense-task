<?php

namespace App\Http\Controllers;

use App\Enums\Adsense\AdFormat;
use App\Enums\Adsense\AdPosition;
use App\Enums\Adsense\AdStatus;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class AdsenseController extends Controller
{
    public function index(Request $request)
    {
        $adsenses = $request->user()->adsenses;

        return view('panel.admin.frontend.adsense.index', compact('adsenses'));
    }

    public function createOrUpdate(Request $request, int $id = null)
    {
        $adsense = $request->user()->adsenses()->findOrNew($id);

        return view('panel.admin.frontend.adsense.form', compact('adsense'));
    }

    public function createOrUpdateSave(Request $request)
    {
        $request->validate([
            'ad_site_url' => 'required|url',
            'ad_position' => ['required', 'integer'],
            'ad_client' => 'required|string',
            'ad_slot' => 'required|string',
            'ad_format' => ['required', 'integer'],
            'ad_status' => ['required', 'integer'],
            'ad_responsive' => 'required|boolean',
        ]);

        $request->user()->adsenses()->updateOrCreate(
            ['id' => $request->id],
            $request->only([
                'ad_site_url',
                'ad_position',
                'ad_client',
                'ad_slot',
                'ad_format',
                'ad_status',
                'ad_responsive',
            ])
        );
    }

    public function delete(Request $request, int $id)
    {
        $request->user()->adsenses()->find($id)->delete();

        return back()->with(['message' => 'Adsense deleted succesfully', 'type' => 'success']);
    }
}
