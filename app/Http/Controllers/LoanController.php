<?php
// app/Http/Controllers/LoanController.php
namespace App\Http\Controllers;

use App\Models\Loan;
use App\Models\Book;
use App\Models\Member;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class LoanController extends Controller
{
    /**
     * Tampilkan daftar peminjaman.
     */
    public function index()
    {
        $loans = Loan::with(['member', 'book'])->paginate(10);
        return view('loans.index', compact('loans'));
    }

    /**
     * Tampilkan form untuk membuat peminjaman baru.
     */
    public function create()
    {
        $members = Member::where('is_active', true)->get();
        $books = Book::where('stock', '>', 0)->get();
        return view('loans.create', compact('members', 'books'));
    }

    /**
     * Simpan peminjaman baru ke database.
     */
    public function store(Request $request)
    {
        $request->validate([
            'member_id' => 'required|exists:members,id',
            'book_id' => 'required|exists:books,id',
            'loan_date' => 'required|date',
            'return_date' => 'nullable|date|after_or_equal:loan_date',
        ]);

        $book = Book::find($request->book_id);

        if ($book->stock <= 0) {
            return redirect()->back()->with('error', 'Stok buku tidak mencukupi.');
        }

        DB::transaction(function () use ($request, $book) {
            Loan::create([
                'member_id' => $request->member_id,
                'book_id' => $request->book_id,
                'loan_date' => $request->loan_date,
                'return_date' => $request->return_date,
                'status' => 'borrowed',
            ]);

            $book->decrement('stock');
        });

        return redirect()->route('loans.index')->with('success', 'Peminjaman berhasil ditambahkan!');
    }

    /**
     * Perbarui status peminjaman menjadi 'returned'.
     */
    public function returnBook(Loan $loan)
    {
        if ($loan->status == 'borrowed') {
            DB::transaction(function () use ($loan) {
                $loan->update([
                    'return_date' => now(),
                    'status' => 'returned',
                ]);
                $loan->book->increment('stock');
            });
            return redirect()->route('loans.index')->with('success', 'Buku berhasil dikembalikan!');
        }
        return redirect()->route('loans.index')->with('error', 'Buku sudah dikembalikan sebelumnya.');
    }

    /**
     * Hapus peminjaman dari database.
     */
    public function destroy(Loan $loan)
    {
        // Jika peminjaman dihapus dan statusnya masih 'borrowed', kembalikan stok buku
        if ($loan->status == 'borrowed') {
            $loan->book->increment('stock');
        }
        $loan->delete();

        return redirect()->route('loans.index')->with('success', 'Peminjaman berhasil dihapus!');
    }
}