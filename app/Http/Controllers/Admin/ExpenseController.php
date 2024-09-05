<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Expense;
use App\Models\CategoryTag;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Storage;

class ExpenseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $expenses = Expense::where('user_id', auth()->id())->get();

        // Recupera tutte le categorie per la selezione
        $categories = CategoryTag::all();

        // Recupero solo le liste dell'utente autenticato
        $expenses = Expense::where('user_id', auth()->id())->paginate(10);

        // return $prova;
        return view('admin.expense.index', [
            'expenses' => $expenses,
            'categories' => $categories,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // Recupera tutte le categorie per la selezione
        $categories = CategoryTag::all();

        return view('admin.expense.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validated = $request->validate(
            [
                'name' => 'required|min:3|max:50|unique:expenses,name',
                'image' => 'nullable|image|max:512'
            ],
            [
                'name.required' => 'il nome è obbligatorio',
                'name.min' => 'Minino 5 caratteri',
                'name.max' => 'Massimo 200 caratteri',
                'name.unique' => 'Nome già esistente',
                'image.image' => 'Il file deve essere un\'immagine (jpg, jpeg, png, bmp, gif, svg o webp).'
            ]
        );

        $formData = $request->all();

        if ($request->hasFile('image')) {
            $img_path = Storage::disk('public')->put('expense_images', $formData['image']);
            $formData['image'] = $img_path;
        }

        $formData['slug'] = Str::slug($formData['name'], '-');

        $newExpense = new Expense;
        $newExpense->fill($formData);
        $newExpense->user_id = Auth::id();
        $newExpense->save();

        if ($request->has('categories')) {
            $newExpense->categoryTags()->attach($request->categories);
        }

        // messaggio flash
        session()->flash('success', 'Progetto creato con successo!');

        return redirect()->route('admin.expenses.show', ['expense' => $newExpense->id]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Expense $expense)
    {
        $expense->load('categoryTags');

        $data = [
            'expense' => $expense,
            'categories' => $expense->categoryTags
        ];

        return view('admin.expense.show', $data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Expense $expense)
    {
        $data = [
            'expense' => $expense
        ];
        return view('admin.expense.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Expense $expense)
    {
        $validated = $request->validate(
            [
                'name' => [
                    'required',
                    'min:3',
                    'max:50',
                    Rule::unique('expenses')->ignore($expense->id),
                ],
                'image' => 'nullable|image|max:512'
            ],
            [
                'name.required' => 'il nome è obbligatorio',
                'name.min' => 'Minino 5 caratteri',
                'name.max' => 'Massimo 200 caratteri',
                'name.unique' => 'Nome già esistente',
                'image.image' => 'Il file deve essere un\'immagine (jpg, jpeg, png, bmp, gif, svg o webp).'
            ]
        );

        $formData = $request->all();

        if ($request->hasFile('image')) {
            // se era presente un immagine la cancella 
            if ($expense->image) {
                Storage::delete($expense->image);
            }

            $img_path = Storage::disk('public')->put('project_images', $formData['image']);

            $formData['image'] = $img_path;
        };

        $formData['slug'] = Str::slug($formData['name'], '-');
        $expense->update($formData);

        return redirect()->route('admin.expenses.show', ['expense' => $expense->id]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Expense $expense)
    {
        $expense->delete();

        return redirect()->route('admin.expenses.index');
    }
}
