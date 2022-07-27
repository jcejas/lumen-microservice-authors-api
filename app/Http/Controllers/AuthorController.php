<?php

namespace App\Http\Controllers;

use App\Models\Author;
use App\Traits\ApiResponser;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Response;

class AuthorController extends Controller
{
    use ApiResponser;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Get All
     *
     * @return void
     */
    public function index()
    {
        $authors = Author::all();
        return $this->successResponse($authors->toArray());
    }

    /**
     * Insert New Author
     *
     * @param Request $request
     * @return void
     */
    public function store(Request $request)
    {
        Validator::make($request->all(), [
            'name' => 'required|max:255',
            'gender' => 'required|max:255|in:male,female',
            'country' => 'required|max:255'
        ])->validate();

        $author = Author::create($request->all());

        return $this->successResponse($author->toArray());
    }

    /**
     * Get By author ID
     *
     * @param integer $author
     * @return void
     */
    public function show(int $author = 0)
    {
        $author = Author::findOrFail($author);
        return $this->successResponse($author->toArray());
    }

    /**
     * Update author by ID
     *
     * @param Request $request
     * @param integer $author
     * @return void
     */
    public function update(Request $request, int $author)
    {
        Validator::make($request->all(), [
            'name' => 'max:255',
            'gender' => 'max:255|in:male,female',
            'country' => 'max:255'
        ])->validate();

        $author = Author::findOrFail($author);
        $author->fill($request->all());

        if ($author->isClean()) {
            return $this->errorResponse('At least one value must change', Response::HTTP_UNPROCESSABLE_ENTITY);
        }
        $author->save();

        return $this->successResponse($author->toArray());
    }

    /**
     * Delete author by ID
     *
     * @param integer $author
     * @return void
     */
    public function destroy(int $author)
    {
        $author = Author::findOrFail($author);
        $author->delete();

        return $this->successResponse($author->toArray());
    }
}
