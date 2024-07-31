<?php

namespace App\Http\Controllers\Teacher;

use App\Helpers\AppHelper;
use App\Http\Controllers\Controller;
use App\Models\Asset;
use App\Models\Lesson;
use Illuminate\Http\Request;

class TeacherAssetController extends Controller
{
    public function teacher_asset_index()
    {
        try {
            $grade = auth()->guard('teacher')->user()->grade;
            $assets = Asset::where('grade', $grade)->get();
            // concat the descript to 255 chars
            foreach ($assets as $asset) {
                $asset->description = substr($asset->description, 0, 25) . '...';
            }
            return view('teacher.asset.index', compact('assets'));
        } catch (\Exception $e) {
            AppHelper::instance()->s_log($e->getMessage(), "teacher_asset_index", "Teacher Asset");
        }
    }

    public function teacher_asset_add()
    {
        try {
            $grade = auth()->guard('teacher')->user()->grade;
            $lessons = Lesson::where('grade', $grade)->get();
            return view('teacher.asset.add', compact('lessons'));
        } catch (\Exception $e) {
            AppHelper::instance()->s_log($e->getMessage(), "teacher_asset_add", "Teacher Asset");
        }
    }

    public function teacher_asset_store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'type' => 'required',
            'file' => 'required',
            'description' => 'required',
            'lesson_id' => 'required',
            'grade' => 'required',
            'state' => 'required',
        ]);
        try {

            $file = $request->file('file');
            $file_name = time() . '_' . auth()->guard('teacher')->user()->id . '.' . $file->getClientOriginalExtension();
            if ($request->type == 'doc') {
                $file->move(public_path('uploads/doc'), $file_name);
                $file_name = 'uploads/doc/' . $file_name;
            } elseif ($request->type == 'video') {
                $file->move(public_path('uploads/video'), $file_name);
                $file_name = 'uploads/video/' . $file_name;
            } elseif ($request->type == 'image') {
                $file->move(public_path('uploads/image'), $file_name);
                $file_name = 'uploads/image/' . $file_name;
            } elseif ($request->type == 'audio') {
                $file->move(public_path('uploads/audio'), $file_name);
                $file_name = 'uploads/audio/' . $file_name;
            } elseif ($request->type == 'zip') {
                $file->move(public_path('uploads/zip'), $file_name);
                $file_name = 'uploads/zip/' . $file_name;
            }

            $asset = new Asset();
            $asset->name = $request->name;
            $asset->type = $request->type;
            $asset->link = $file_name;
            $asset->description = $request->description;
            $asset->lesson_id = $request->lesson_id;
            $asset->grade = auth()->guard('teacher')->user()->grade;
            $asset->state = $request->state;
            $asset->save();
            return redirect()->route('teacher_asset_index')->with('success', 'Asset added successfully');
        } catch (\Exception $e) {
            AppHelper::instance()->s_log($e->getMessage(), "teacher_asset_store", "Teacher Asset");
        }
    }

    public function teacher_asset_edit(Request $request)
    {
        $grade = auth()->guard('teacher')->user()->grade;
        $lessons = Lesson::where('grade', $grade)->get();
        $asset = Asset::where('grade', $grade)->find($request->id);
        return view('teacher.asset.edit', compact('asset', 'lessons'));
    }

    public function teacher_asset_update(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'description' => 'required',
            'lesson_id' => 'required',
            'state' => 'required',
        ]);
        try {
            $asset = Asset::find($request->id);
            $asset->name = $request->name;
            $asset->description = $request->description;
            $asset->lesson_id = $request->lesson_id;
            $asset->state = $request->state;
            $asset->save();
            return redirect()->route('teacher_asset_index')->with('success', 'Asset updated successfully');
        } catch (\Exception $e) {
            AppHelper::instance()->s_log($e->getMessage(), "teacher_asset_update", "Teacher Asset");
        }
    }

    public function teacher_asset_delete(Request $request)
    {
        try {
            $asset = Asset::find($request->id);
            if (file_exists($asset->link)) {
                unlink($asset->link);
            }
            $asset->delete();
            return redirect()->route('teacher_asset_index')->with('success', 'Asset deleted successfully');
        } catch (\Exception $e) {
            AppHelper::instance()->s_log($e->getMessage(), "teacher_asset_delete", "Teacher Asset");
        }
    }
}
