<?php

namespace App\Http\Controllers\Web\Backend\CMS;

use App\Http\Controllers\Controller;
use App\Models\Testimonial;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\View\View;
use Yajra\DataTables\DataTables;

class TestimonialController extends Controller {
    /**
     * Display a listing of the testimonials.
     *
     * @param Request $request
     * @return View|JsonResponse
     * @throws Exception
     */
    public function index(Request $request): View | JsonResponse {
        if ($request->ajax()) {
            $data = Testimonial::latest()->get();
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('description', function ($data) {
                    $description      = $data->description;
                    $shortDescription = strlen($description) > 100 ? substr($description, 0, 100) . '...' : $description;
                    return '<p>' . $shortDescription . '</p>';
                })
                ->addColumn('status', function ($clientsFeedback) {
                    $status = '<div class="form-check form-switch" style="margin-left: 40px; width: 50px; height: 24px;">';
                    $status .= '<input class="form-check-input" type="checkbox" role="switch" id="SwitchCheck' . $clientsFeedback->id . '" ' . ($clientsFeedback->status == 'active' ? 'checked' : '') . ' onclick="showStatusChangeAlert(' . $clientsFeedback->id . ')">';
                    $status .= '</div>';

                    return $status;
                })
                ->addColumn('action', function ($clientsFeedback) {
                    return '
                            <div class="hstack gap-3 fs-base">
                                <a href="' . route('cms.testimonials.edit', ['id' => $clientsFeedback->id]) . '" class="link-primary text-decoration-none" title="Edit">
                                    <i class="ri-pencil-line" style="font-size: 24px;"></i>
                                </a>

                                <a href="javascript:void(0);" onclick="showDeleteConfirm(' . $clientsFeedback->id . ')" class="link-danger text-decoration-none" title="Delete">
                                    <i class="ri-delete-bin-5-line" style="font-size: 24px;"></i>
                                </a>
                            </div>
                        ';
                })
                ->rawColumns(['description', 'status', 'action'])
                ->make();
        }
        return view('backend.layouts.cms.testimonials.index');
    }

    /**
     * Show the form for creating a new testimonials.
     *
     * @return View
     */
    public function create(): View {
        return view('backend.layouts.cms.testimonials.create');
    }

    /**
     * Store a newly created testimonials in storage.
     *
     * @param Request $request
     * @return RedirectResponse
     */
    public function store(Request $request): RedirectResponse {
        $validator = Validator::make($request->all(), [
            'name'        => 'required|string',
            'title'       => 'nullable|string',
            'image'       => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:20480',
            'description' => 'required|string',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        try {
            $testimonials              = new Testimonial();
            $testimonials->name        = $request->name;
            $testimonials->title       = $request->title;
            $testimonials->image       = $request->image;
            $testimonials->description = $request->description;

            $testimonials->save();
            return redirect()->route('cms.testimonials.index')->with('t-success', 'Testimonials Create Successfully');
        } catch (Exception) {
            return redirect()->back()->with('t-error', 'Failed to create')->withInput();
        }
    }

    /**
     * Show the form for editing the specified testimonials.
     *
     * @param  int  $id
     * @return View
     */
    public function edit(int $id): View {
        $clientsFeedback = Testimonial::findOrFail($id);
        return view('backend.layouts.cms.testimonials.edit', compact('clientsFeedback'));
    }

    /**
     * Update the specified testimonials in storage.
     *
     * @param Request $request
     * @param  int  $id
     * @return RedirectResponse
     */
    public function update(Request $request, int $id): RedirectResponse {
        $validator = Validator::make($request->all(), [
            'rating'      => 'required|integer',
            'description' => 'required|string',
            'name'        => 'required|string',
            'title'       => 'required|string',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        try {
            $clientsFeedback              = Testimonial::findOrFail($id);
            $clientsFeedback->rating      = $request->rating;
            $clientsFeedback->description = $request->description;
            $clientsFeedback->name        = $request->name;
            $clientsFeedback->title       = $request->title;

            $clientsFeedback->save();
            return redirect()->route('cms.testimonials.index')->with('t-success', 'Clients Feedback Update Successfully');
        } catch (Exception) {
            return redirect()->back()->with('t-error', 'Failed to update');
        }
    }

    /**
     * Toggle the status of the specified testimonials.
     *
     * @param  int  $id
     * @return JsonResponse
     */
    public function status(int $id): JsonResponse {
        $clientsFeedback = Testimonial::findOrFail($id);

        if ($clientsFeedback->status == 'active') {
            $clientsFeedback->status = 'inactive';
            $clientsFeedback->save();
            return response()->json([
                'success' => false,
                'message' => 'Unpublished Successfully.',
                'data'    => $clientsFeedback,
            ]);
        } else {
            $clientsFeedback->status = 'active';
            $clientsFeedback->save();
            return response()->json([
                'success' => true,
                'message' => 'Published Successfully.',
                'data'    => $clientsFeedback,
            ]);
        }
    }

    /**
     * Remove the specified testimonials from storage.
     *
     * @param  int  $id
     * @return JsonResponse
     */
    public function destroy(int $id): JsonResponse {
        $clientsFeedback = Testimonial::findOrFail($id);
        $clientsFeedback->delete();

        return response()->json([
            't-success' => true,
            'message'   => 'Deleted successfully.',
        ]);
    }
}
