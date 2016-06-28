<?php

namespace App\Http\Controllers;

use App\Http\Requests\TypeRequest;
use App\Page;
use App\Type;
use Illuminate\Http\Request;

use App\Http\Requests;

class TypeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $types = Type::all();
        return view('type.index', compact('types'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        $types = Type::typeList();
        $types[0] = 'Корінь';
        return view('type.create',['types' => $types, 'currentType' => 0]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param TypeRequest|Request $request
     * @return Response
     */
    public function store(TypeRequest $request)
    {
        Type::create($request->all());

        return redirect('admin/type');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id)
    {
        $type = Type::findOrFail($id);
        $types = Type::typeEditList($id);
        $children = Type::where('parent_id', $id)->get();
        $types[0] = 'Корінь';
        return view('type.edit', ['type' => $type, 'children' => $children, 'types' => $types, 'currentType' => $type->parent_id]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  Request  $request
     * @param  int  $id
     * @return Response
     */
    public function update(Request $request, $id)
    {
        $type = Type::findOrFail($id);
        $type->update($request->all());
        return redirect('admin/type');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {
        Type::destroy($id);
        return redirect('admin/type');
    }

    public function getAll()
    {
        $types = Type::all();
        return response(['types' => $types]);
    }
}
