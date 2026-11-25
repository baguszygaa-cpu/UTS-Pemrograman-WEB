<?php

namespace App\Http\Controllers;

use App\Models\Biodata;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\View\View;

class BiodataController extends Controller
{
    /**
     * Display the biodata cards page.
     */
    public function index(): View
    {
        $biodatas = Biodata::query()->orderBy('id')->get();

        return view('welcome', compact('biodatas'));
    }

    /**
     * Store a newly created biodata card.
     */
    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'nama' => ['required', 'string', 'max:255'],
            'deskripsi' => ['required', 'string'],
            'foto' => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp', 'max:2048'],
        ]);

        $fotoPath = $this->handlePhotoUpload($request);

        Biodata::create([
            'nama' => $validated['nama'],
            'deskripsi' => $validated['deskripsi'],
            'foto' => $fotoPath,
        ]);

        return redirect()->route('home')->with('success', 'Biodata berhasil ditambahkan.');
    }

    /**
     * Update an existing biodata card.
     */
    public function update(Request $request, Biodata $biodata): RedirectResponse
    {
        $validated = $request->validate([
            'nama' => ['required', 'string', 'max:255'],
            'deskripsi' => ['required', 'string'],
            'foto' => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp', 'max:2048'],
        ]);

        $fotoPath = $biodata->foto;
        if ($request->hasFile('foto')) {
            $this->deleteUploadedPhoto($biodata->foto);
            $fotoPath = $this->handlePhotoUpload($request);
        }

        $biodata->update([
            'nama' => $validated['nama'],
            'deskripsi' => $validated['deskripsi'],
            'foto' => $fotoPath,
        ]);

        return redirect()->route('home')->with('success', 'Biodata berhasil diperbarui.');
    }

    /**
     * Remove the specified biodata card.
     */
    public function destroy(Biodata $biodata): RedirectResponse
    {
        $this->deleteUploadedPhoto($biodata->foto);
        $biodata->delete();

        return redirect()->route('home')->with('success', 'Biodata berhasil dihapus.');
    }

    /**
     * Move uploaded photo into public/uploads/biodata and return its relative path.
     */
    private function handlePhotoUpload(Request $request): ?string
    {
        if (! $request->hasFile('foto')) {
            return null;
        }

        $directory = public_path('uploads/biodata');
        if (! File::exists($directory)) {
            File::makeDirectory($directory, 0755, true);
        }

        $file = $request->file('foto');
        $filename = uniqid('biodata_', true).'.'.$file->getClientOriginalExtension();
        $file->move($directory, $filename);

        return 'uploads/biodata/'.$filename;
    }

    /**
     * Delete user-uploaded photo file while preserving seeded sample images.
     */
    private function deleteUploadedPhoto(?string $path): void
    {
        if ($path && str_starts_with($path, 'uploads/biodata/')) {
            $fullPath = public_path($path);
            if (File::exists($fullPath)) {
                File::delete($fullPath);
            }
        }
    }
}
