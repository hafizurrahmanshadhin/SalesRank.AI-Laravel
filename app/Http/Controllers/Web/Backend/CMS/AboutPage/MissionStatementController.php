<?php

namespace App\Http\Controllers\Web\Backend\CMS\AboutPage;

use App\Helpers\Helper;
use App\Http\Controllers\Controller;
use App\Models\MissionStatement;
use Exception;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\View\View;

class MissionStatementController extends Controller {
    /**
     * Display mission statement.
     *
     * @return RedirectResponse|View
     */
    public function index(): RedirectResponse | View {
        try {
            $missionStatement = MissionStatement::firstOrNew();
            return view('backend.layouts.cms.about-page.mission-statement', compact('missionStatement'));
        } catch (Exception $e) {
            return back()->with('t-error', $e->getMessage());
        }
    }

    /**
     * Update mission statement.
     *
     * @param Request $request
     * @return RedirectResponse
     */
    public function update(Request $request): RedirectResponse {
        try {
            $validator = Validator::make($request->all(), [
                'description'  => 'required|string',
                'image'        => 'required|image|mimes:jpg,jpeg,png,gif|max:20480',
                'remove_image' => 'nullable|boolean',
            ]);

            if ($validator->fails()) {
                return redirect()->back()->withErrors($validator)->withInput();
            }

            $missionStatement              = MissionStatement::firstOrNew();
            $missionStatement->description = $request->description;

            //* Handle image file
            if ($request->boolean('remove_image')) {
                if ($missionStatement->image) {
                    Helper::fileDelete(public_path($missionStatement->image));
                    $missionStatement->image = null;
                }
            } elseif ($request->hasFile('image')) {
                if ($missionStatement->image) {
                    Helper::fileDelete(public_path($missionStatement->image));
                }
                $missionStatement->image = Helper::fileUpload($request->file('image'), 'missionStatement', $missionStatement->image);
            }
            $missionStatement->save();

            return redirect()->route('cms.about-page.mission-statement.index')->with('t-success', 'Mission statement updated successfully.');
        } catch (Exception $e) {
            return back()->with('t-error', $e->getMessage());
        }
    }
}
