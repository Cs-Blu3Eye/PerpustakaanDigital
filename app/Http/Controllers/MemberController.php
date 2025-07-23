<?php
// app/Http/Controllers/MemberController.php
namespace App\Http\Controllers;

use App\Models\Member;
use Illuminate\Http\Request;

class MemberController extends Controller
{
    /**
     * Tampilkan daftar anggota.
     */
    public function index()
    {
        $members = Member::paginate(5);
        return view('members.index', compact('members'));
    }

    /**
     * Tampilkan form untuk membuat anggota baru.
     */
    public function create()
    {
        return view('members.create');
    }

    /**
     * Simpan anggota baru ke database.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'nim' => 'required|string|unique:members,nim|max:20',
            'major' => 'required|string|max:255',
            'email' => 'required|email|unique:members,email|max:255',
            'is_active' => 'boolean',
        ]);

        Member::create($request->all());

        return redirect()->route('members.index')->with('success', 'Anggota berhasil ditambahkan!');
    }

    /**
     * Tampilkan detail anggota.
     */
    public function show(Member $member)
    {
        return view('members.show', compact('member'));
    }

    /**
     * Tampilkan form untuk mengedit anggota.
     */
    public function edit(Member $member)
    {
        return view('members.edit', compact('member'));
    }

    /**
     * Perbarui anggota di database.
     */
    public function update(Request $request, Member $member)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'nim' => 'required|string|unique:members,nim,' . $member->id . '|max:20',
            'major' => 'required|string|max:255',
            'email' => 'required|email|unique:members,email,' . $member->id . '|max:255',
            'is_active' => 'boolean',
        ]);

        $member->update($request->all());

        return redirect()->route('members.index')->with('success', 'Anggota berhasil diperbarui!');
    }

    /**
     * Hapus anggota dari database.
     */
    public function destroy(Member $member)
    {
        $member->delete();

        return redirect()->route('members.index')->with('success', 'Anggota berhasil dihapus!');
    }
}