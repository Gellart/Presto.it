<?php

namespace App\Http\Controllers;
use File;
use App\Models\Announcement;
use Illuminate\Http\Request;

class AnnouncementController extends Controller
{
    public function createAnnouncement() {
      return view ('announcements.create');  
    }

    public function showAnnouncement(Announcement $announcement){

      return view('announcements.show',compact('announcement'));

    }

    public function indexAnnouncement(){

      $announcements=Announcement::where('is_accepted',true)->paginate(12);
      return view('announcements.index',compact('announcements'));

    }

    public function edit(Announcement $announcement, $id){
      $announcement=Announcement::find($id);
      return view('announcements.edit', ['announcement'=>$announcement] );
    }

    public function destroy($id){
      $announcement=Announcement::find($id);
      $announcement->delete();
      File::deleteDirectory(storage_path("app/public/announcements/$id"));
      return back()->with('message',"L'annuncio è stato eliminato");
    }
}
