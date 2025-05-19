<?php

namespace App\Http\Controllers\Web\Backend\CMS\AICoachPage;

use App\Helpers\Helper;
use App\Http\Controllers\Controller;
use App\Models\Document;
use Illuminate\Http\Request;

class DocumentController extends Controller {
    public function index() {
        $setting = Document::first() ?? new Document();
        return view('backend.layouts.cms.ai-coach-page.documents', compact('setting'));
    }

    public function update(Request $request) {
        $setting = Document::first() ?? new Document();

        // Generate Script upload
        if ($request->hasFile('generate_script')) {
            if ($setting->generate_script) {
                Helper::fileDelete($setting->generate_script); // Delete old file
            }
            $path                     = Helper::fileUpload($request->file('generate_script'), 'docs', 'generate_script');
            $setting->generate_script = $path;
        }

        // Practice Pitch upload
        if ($request->hasFile('practice_pitch')) {
            if ($setting->practice_pitch) {
                Helper::fileDelete($setting->practice_pitch); // Delete old file
            }
            $path                    = Helper::fileUpload($request->file('practice_pitch'), 'docs', 'practice_pitch');
            $setting->practice_pitch = $path;
        }

        // Remove generate_script check
        if ($request->remove_generate_script) {
            if ($setting->generate_script) {
                Helper::fileDelete($setting->generate_script);
            }
            $setting->generate_script = null;
        }

        // Remove practice_pitch check
        if ($request->remove_practice_pitch) {
            if ($setting->practice_pitch) {
                Helper::fileDelete($setting->practice_pitch);
            }
            $setting->practice_pitch = null;
        }

        $setting->save();

        return redirect()
            ->route('cms.ai-coach-page.documents.index')
            ->with('t-success', 'Documents updated successfully!');
    }
}
