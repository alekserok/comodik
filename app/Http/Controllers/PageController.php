<?php

namespace App\Http\Controllers;

use App\Http\Requests\PageRequest;
use App\Page;
use App\Type;
use Illuminate\Http\Request;

use App\Http\Requests;
use Illuminate\Support\Facades\Storage;

class PageController extends Controller
{
    protected $page;
    protected $file;

    /**
     * @param Page $page
     * @param Storage $file
     */
    public function __construct(Page $page, Storage $file)
    {
        $this->page = $page;
        $this->file = $file;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $pages = $this->page->all();
        return view('page.index', ['pages' => $pages]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $types = Type::typeList();
        return view('page.create', ['types' => $types, 'currentType' => 1]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param PageRequest|Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(PageRequest $request)
    {
        $request = $this->saveFile($request);

        $this->page->create($request->all());

        return redirect('admin' . '/page');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $nid
     * @return \Illuminate\Http\Response
     */
    public function edit($nid)
    {
        $page = $this->page->findOrFail($nid);
        $types = Type::typeList();
        $currentType = $page->type_id;
        return view('page.edit', compact('page', 'types', 'currentType'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param PageRequest|Request $request
     * @param  int $nid
     * @return \Illuminate\Http\Response
     */
    public function update(PageRequest $request, $nid)
    {
        $page = $this->page->find($nid);

        $request = $this->saveFile($request, $page->image);

        $page->update($request->all());

        return redirect('admin' . '/page');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $nid
     * @return \Illuminate\Http\Response
     */
    public function destroy($nid)
    {
        $page = $this->page->find($nid);

        if ($page->image) {
            unlink(public_path() . $page->image);
        }

        $page->delete();
        return redirect('admin' . '/page');
    }

    /**
     * @param Request $request
     * @param null|string $imagePath
     * @return Request
     */
    public function saveFile($request, $imagePath = null)
    {
        if ($request->hasFile('file')) {
            $file = $request->file('file');
            $destinationPath = public_path() . '/images/pageImages/';
            $filename = str_random(6) . '_' . $file->getClientOriginalName();
            $file->move($destinationPath, $filename);
            $request->merge(['image' => '/images/pageImages/' . $filename]);

            if ($imagePath) {
                unlink(public_path() . $imagePath);
            }
        }

        if (!$request->hasFile('file') && !$request->has('image') && $imagePath) {
            unlink(public_path() . $imagePath);
        }

        return $request;
    }
    
    /**
     * @param $type_id
     * @return array|\Illuminate\View\View|mixed
     */
    public function getByType($type_id)
    {
        $pages = $this->page->where('type_id', $type_id)->get();
        return response(['pages' => $pages]);
    }

    /**
     * @param $id
     * @return array|\Illuminate\View\View|mixed
     */
    public function showPage($id)
    {
        $page = $this->page->find($id);
        return response($page);
    }
}
