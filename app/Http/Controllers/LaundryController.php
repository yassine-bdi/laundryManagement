<?php

namespace App\Http\Controllers;

use App\Http\Requests\LaundryRequest;
use App\Models\Laundry;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;


class LaundryController extends Controller
{
  public function __construct()
  {
    $this->middleware(['auth', 'Language']);
  }

  public function Laundries()
  {
    return view('admin.laundries', ['laundries' => Laundry::paginate(12)]);
  }

  /**
   * addLaundries
   *
   * @param  mixed $request
   * @return void
   */
  public function addLaundries(LaundryRequest $request)
  {
    $validatedData = $request->validated();
    if (!Laundry::where('name', $validatedData['name'])->exists()) {
      $laundry = new Laundry();
      $laundry->name = strip_tags($validatedData['name']);
      if ($request->hasFile('image')) {
        $laundry->photo = $request->file('image')->store('laundries', 'public');
        $image = Image::make(public_path('storage/' . $laundry->photo))->resize(300, 300);
        $image->save();
      }
      $laundry->save();
      return to_route('laundries')->with('statut', 'laundry added with success');
    } else {
      return to_route('laundries')->with('error', 'laundry already exists!');
    }
  }

  public function editLaundries(LaundryRequest $request, int $id)
  {
    $validatedData = $request->validated(); 
    if (Laundry::where('id', $id)->exists()) {
      $laundry = Laundry::find($id);
      $laundry->name = strip_tags($validatedData->name);
      if ($laundry->photo != null) {
        File::delete('storage/' . $laundry->photo);
      }
      if ($request->hasFile('image')) {
        $laundry->photo = $request->file('image')->store('laundries', 'public');
        $image = Image::make(public_path('storage/' . $laundry->photo))->resize(300, 300);
        $image->save();
      }
      $laundry->save();
      return to_route('laundries')->with('statut', 'laundry edited with success');
    } else {
      return to_route('laundries')->with('error', 'laundry does not exist!');
    }
  }

  /**
   * @param \Illuminate\Http\Request $request
   *  @param int $id
   * @return \Illuminate\Http\RedirectResponse
   */
  public function deleteLaundry(Request $request, int $id)
  {
    if (Laundry::where('id', $id)->exists()) {
      $laundry = Laundry::find($id);
      if ($laundry->photo != null) {
        File::delete('storage/' . $laundry->photo);
      }
      $laundry->delete();
      return to_route('laundries')->with('statut', 'laundry deleted with success');
    } else {
      return to_route('laundries')->with('error', 'laundry does not exist!');
    }
  }
}
