<?php

namespace App\Http\Controllers;

use App\NewsList;
use Illuminate\Http\Request;
use App\Http\Requests\NewsListRequest;
use Illuminate\Support\Facades\DB;

class NewsListController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->getUser()->hasPermission(['select'], 'news_lists');

        // Retrieve the full news relations list
        $newsListsList = DB::connection($this->getUser()->getRole->name)->table('news_lists')->paginate(20);

        return view('newsLists.index', array(
            'newsList' => $newsListsList
        ));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $this->getUser()->hasPermission(['insert'], 'news_lists');

        return view('newsLists.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\NewsListRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(NewsListRequest $request)
    {
        $this->getUser()->hasPermission(['insert'], 'news_lists');
        // Set the connection to use after having checked the permissions
        $newsList = new NewsList();
        $newsList->setConnection($this->getUser()->getRole->name);

        $newsList->fill($request->all());

        if ($newsList->save()) {
            return redirect()->route('newslists.index')->with('success', 'News relation successfully created');
        } else {
            return back()->withErrors('An error occurred while saving the news relation. Please try again later.');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $idNewsList
     * @return \Illuminate\Http\Response
     */
    public function show(int $idNewsList)
    {
        $this->getUser()->hasPermission(['select'], 'news');

        $newsList = new NewsList();
        $newsList->setConnection($this->getUser()->getRole->name);
        $newsList = $newsList->findOrFail($idNewsList);

        return view('newsLists.show', ['newsList' => $newsList]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $idNewsList
     * @return \Illuminate\Http\Response
     */
    public function edit(int $idNewsList)
    {
        $this->getUser()->hasPermission(['select'], 'news');

        $newsList = new NewsList();
        $newsList->setConnection($this->getUser()->getRole->name);

        $newsList = $newsList->findOrFail($idNewsList);

        return view('newsLists.edit', array(
            'newsList' => $newsList
        ));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\NewsListRequest  $request
     * @param  int  $idNewsList
     * @return \Illuminate\Http\Response
     */
    public function update(NewsListRequest $request, int $idNewsList)
    {
        $this->getUser()->hasPermission(['update'], 'news_lists');
        $newsList = new NewsList();
        $newsList->setConnection($this->getUser()->getRole->name);

        $newsList = $newsList->findOrFail($idNewsList);
        $newsList->fill($request->all());

        if ($newsList->save()) {
            return redirect()->route('newslists.show', ['idNewsList' => $newsList->id])->with('success', 'News relation successfully updated');
        } else {
            return back()->withErrors('An error occurred while saving the news relation. Please try again later.');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \Illuminate\Http\Resquest
     * @param  \App\NewsList  $newsList
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, int $idNewsList)
    {
        $this->getUser()->hasPermission(['delete'], 'news_lists');

        if ($idNewsList !== 0) {
            $newsList = new NewsList();
            $newsList->setConnection($this->getUser()->getRole->name);
            $newsList = $newsList->findOrFail($idNewsList);

            if ($newsList->delete()) {
                return redirect()->route('newslists.index')->with('success', 'News relation successfully deleted');
            } else {
                return back()->with('errors', 'An error occurred while deleting the relation');
            }
        } else {
            $newsListsToDelete = $request->input('list');
            $result = true;

            foreach ($newsListsToDelete as $key => $newsListId) {
                $newsList = new NewsList();
                $newsList->setConnection($this->getUser()->getRole->name);
                $newsList = $newsList->findOrFail($newsListId);

                if ($newsList->delete()) {
                    continue;
                } else {
                    $result = false;
                    break;
                }
            }

            if ($result) {
                $request->session()->flash('success', 'The selected news relations were successfully deleted');
            } else {
                $request->session()->flash('errors', 'An error occurred while deleting the selected relations');
            }

            return 'newslists';
        }
    }
}
