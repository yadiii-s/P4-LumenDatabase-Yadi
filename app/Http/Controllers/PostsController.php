<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;



class PostsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function index(Request $request)
    {
        $acceptHeader = $request->header('Accept');

        // validasi: hanya application/json atau application/xml yang valid
        if ($acceptHeader === 'application/json' || $acceptHeader === 'application/xml') {
            $posts = Post::OrderBy("id", "DESC")->paginate(10);

            if ($acceptHeader === 'application/json') {
                // response json
                return response()->json($posts->items('data'), 200);
            } else {
                // create xml posts element
                $xml = new \SimpleXMLElement('<posts/>');
                foreach ($posts->items('data') as $item) {
                    // create xml post element
                    $xmlItem = $xml->addChild('post');

                    // mengubah setiap field post menjadi bentuk xml
                    $xmlItem->addChild('id', $item->id);
                    $xmlItem->addChild('title', $item->title);
                    $xmlItem->addChild('status', $item->status);
                    $xmlItem->addChild('content', $item->content);
                    $xmlItem->addChild('user_id', $item->user_id);
                    $xmlItem->addChild('created_at', $item->created_at);
                    $xmlItem->addChild('updated_at', $item->updated_at);
                }
                return $xml->asXML();
            }
        } else {
            return response('Not Acceptable!', 406);
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */

    public function store(Request $request)
    {
        $acceptHeader = $request->header('Accept');

        if ($acceptHeader === 'application/json' || $acceptHeader === 'application/xml') {

            $contentTypeHeader = $request->header('Content-Type');

            if ($contentTypeHeader === 'application/json') {
                $input = $request->all();
                $post = Post::create($input);

                if ($acceptHeader === 'application/json') {
                    return response()->json($post, 200);
                } else {
                    $xml = new \SimpleXMLElement('<post/>');

                    $xml->addChild('id', $post->id);
                    $xml->addChild('title', $post->title);
                    $xml->addChild('status', $post->status);
                    $xml->addChild('content', $post->content);
                    $xml->addChild('user_id', $post->user_id);
                    $xml->addChild('created_at', $post->created_at);
                    $xml->addChild('updated_at', $post->updated_at);
                    return $xml->asXML();
                }
            } else {
                return response('Unsupported Media Type', 415);
            }
        } else {
            return response('Not Acceptable!', 406);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, $id)
    {
        $acceptHeader = $request->header('Accept');

        // validasi: hanya application/json atau application/xml yang valid
        if ($acceptHeader === 'application/json' || $acceptHeader === 'application/xml') {
            $post = Post::find($id);

            if (!$post) {
                abort(404);
            }

            if ($acceptHeader === 'application/json') {
                // response json
                return response()->json($post, 200);
            } else {
                // create xml post element
                $xml = new \SimpleXMLElement('<post/>');

                // mengubah setiap field post menjadi bentuk xml
                $xml->addChild('id', $post->id);
                $xml->addChild('title', $post->title);
                $xml->addChild('status', $post->status);
                $xml->addChild('content', $post->content);
                $xml->addChild('user_id', $post->user_id);
                $xml->addChild('created_at', $post->created_at);
                $xml->addChild('updated_at', $post->updated_at);
                return $xml->asXML();
            }
        } else {
            return response('Not Acceptable!', 406);
        }
    }


    public function update(Request $request, $id)
    {
        $acceptHeader = $request->header('Accept');

        // validasi: hanya application/json atau application/xml yang valid
        if ($acceptHeader === 'application/json' || $acceptHeader === 'application/xml') {

            $contentTypeHeader = $request->header('Content-Type');

            // validasi: hanya application/json yang valid
            if ($contentTypeHeader === 'application/json') {
                $input = $request->all();

                $post = Post::find($id);

                if (!$post) {
                    abort(404);
                }

                $post->fill($input);
                $post->save();

                if ($acceptHeader === 'application/json') {
                    // response json
                    return response()->json($post, 200);
                } else {
                    // create xml post element
                    $xml = new \SimpleXMLElement('<post/>');

                    // mengubah setiap field post menjadi bentuk xml
                    $xml->addChild('id', $post->id);
                    $xml->addChild('title', $post->title);
                    $xml->addChild('status', $post->status);
                    $xml->addChild('content', $post->content);
                    $xml->addChild('user_id', $post->user_id);
                    $xml->addChild('created_at', $post->created_at);
                    $xml->addChild('updated_at', $post->updated_at);
                    return $xml->asXML();
                }
            } else {
                return response('Unsupported Media Type', 415);
            }
        } else {
            return response('Not Acceptable!', 406);
        }
    }




    public function destroy(Request $request, $id)
    {
        $acceptHeader = $request->header('Accept');

        // validasi: hanya application/json atau application/xml yang valid
        if ($acceptHeader === 'application/json' || $acceptHeader === 'application/xml') {
            $post = Post::find($id);

            if (!$post) {
                abort(404);
            }

            $post->delete();
            $message = ['message' => 'deleted successfully', 'post_id' => $id];

            if ($acceptHeader === 'application/json') {
                // response json
                return response()->json($message, 200);
            } else {
                // create xml result element
                $xml = new \SimpleXMLElement('<result/>');
                $xml->addChild('message', $message['message']);
                $xml->addChild('post_id', $message['post_id']);
                return $xml->asXML();
            }
        } else {
            return response('Not Acceptable!', 406);
        }
    }
}
