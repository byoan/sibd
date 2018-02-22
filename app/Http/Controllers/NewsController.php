<?php

namespace App\Http\Controllers;

use App\News;
use Illuminate\Http\Request;
use App\Http\Requests\NewsRequest;
use Illuminate\Support\Facades\DB;

class NewsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->getUser()->hasPermission(['select'], 'news');

        // Retrieve the full ads list
        $newsList = DB::connection($this->getUser()->getRole->name)->table('news')->paginate(20);

        return view('news.index', array(
            'newsList' => $newsList
        ));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $this->getUser()->hasPermission(['insert'], 'news');

        return view('news.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\NewsRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(NewsRequest $request)
    {
        $this->getUser()->hasPermission(['insert'], 'news');
        // Set the connection to use after having checked the permissions
        $news = new News();
        $news->setConnection($this->getUser()->getRole->name);

        $news->fill($request->all());

        if ($news->save()) {
            return redirect()->route('news.index')->with('success', 'News successfully created');
        } else {
            return back()->withErrors('An error occurred while saving the news. Please try again later.');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $idNews
     * @return \Illuminate\Http\Response
     */
    public function show(int $idNews)
    {
        $this->getUser()->hasPermission(['select'], 'news');

        $news = new News();
        $news->setConnection($this->getUser()->getRole->name);
        $news = $news->findOrFail($idNews);

        return view('news.show', ['news' => $news]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $idNews
     * @return \Illuminate\Http\Response
     */
    public function edit(int $idNews)
    {
        $this->getUser()->hasPermission(['select'], 'news');

        $news = new News();
        $news->setConnection($this->getUser()->getRole->name);

        $news = $news->findOrFail($idNews);

        return view('news.edit', array(
            'news' => $news
        ));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\NewsRequest  $request
     * @param  \App\News  $news
     * @return \Illuminate\Http\Response
     */
    public function update(NewsRequest $request, News $news)
    {
        $this->getUser()->hasPermission(['update'], 'news');

        $news->setConnection($this->getUser()->getRole->name);

        $news->fill($request->all());

        if ($news->save()) {
            return redirect()->route('news.show', ['idNews' => $news->id])->with('success', 'News successfully updated');
        } else {
            return back()->withErrors('An error occurred while saving the news. Please try again later.');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \Illuminate\Http\Resquest
     * @param  \App\News  $news
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, int $idNews)
    {
        $this->getUser()->hasPermission(['delete'], 'news');

        if ($idNews !== 0) {
            $news = new News();
            $news->setConnection($this->getUser()->getRole->name);
            $news = $news->findOrFail($idNews);

            if ($news->delete()) {
                return redirect()->route('news.index')->with('success', 'News successfully deleted');
            } else {
                return back()->with('errors', 'An error occurred while deleting the item');
            }
        } else {
            $newsToDelete = $request->input('list');
            $result = true;

            foreach ($newsToDelete as $key => $newsId) {
                $news = new News();
                $news->setConnection($this->getUser()->getRole->name);
                $news = $news->findOrFail($newsId);

                if ($news->delete()) {
                    continue;
                } else {
                    $result = false;
                    break;
                }
            }

            if ($result) {
                $request->session()->flash('success', 'The selected news were successfully deleted');
            } else {
                $request->session()->flash('errors', 'An error occurred while deleting the selected news');
            }

            return 'news';
        }
    }
}
