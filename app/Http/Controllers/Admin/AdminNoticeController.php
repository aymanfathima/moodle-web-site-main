<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Notice;
use Illuminate\Http\Request;

class AdminNoticeController extends Controller
{
    function admin_notice_index()
    {
        $notices = Notice::all();
        return view('admin.notice.index', compact('notices'));
    }

    function admin_notice_add()
    {
        return view('admin.notice.add');
    }

    function admin_notice_store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'start_date' => 'required',
            'start_time' => 'required',
            'end_date' => 'required',
            'end_time' => 'required',
            'state' => 'required|digits:1'
        ]);

        $notice = new Notice();
        $notice->title = $request->title;
        $notice->description = $request->description;
        $notice->start_date = $request->start_date . ' ' . $request->start_time;
        $notice->end_date = $request->end_date . ' ' . $request->end_time;
        $notice->state = $request->state;
        $notice->save();

        return redirect()->route('admin_notice_index');
    }

    function admin_notice_edit(Request $request)
    {
        $notice = Notice::find($request->id);
        $notice->start_time = date('H:i:s', strtotime($notice->start_date));
        $notice->start_date = date('Y-m-d', strtotime($notice->start_date));
        $notice->end_time = date('H:i:s', strtotime($notice->end_date));
        $notice->end_date = date('Y-m-d', strtotime($notice->end_date));
        return view('admin.notice.edit', compact('notice'));
    }

    function admin_notice_update(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'start_date' => 'required',
            'start_time' => 'required',
            'end_date' => 'required',
            'end_time' => 'required',
            'state' => 'required|digits:1'
        ]);

        $notice = Notice::find($request->id);
        $notice->title = $request->title;
        $notice->description = $request->description;
        $notice->start_date = $request->start_date . ' ' . $request->start_time;
        $notice->end_date = $request->end_date . ' ' . $request->end_time;
        $notice->state = $request->state;
        $notice->save();

        return redirect()->route('admin_notice_index');
    }

    function admin_notice_delete(Request $request)
    {
        $notice = Notice::find($request->id);
        $notice->delete();
        return response()->json(['status' => 'success', 'deleted' => true]);
    }
}
