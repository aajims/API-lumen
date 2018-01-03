<?php

namespace App\Http\Foo\Controllers;

use App\Traits\ResultsetTrait;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Validator;

class ExampleController extends FooController
{
    use ResultsetTrait;

    /**
     * Create a new controller instance.
     */
    public function __construct()
    {
    }

    /**
     * @return \Illuminate\Http\JsonResponse
     */
    public function listAction()
    {
        $config = config('foo');
        $list = DB::connection('framework')
                  ->select('SELECT * FROM logs LIMIT 10');
        $array = [
            'config' => $config,
            'list'   => $list,
        ];

        return self::successResponse($array);
    }

    /**
     * Transaction action.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\JsonResponse
     * @throws \Exception
     * @throws \Throwable
     */
    public function transactionAction(Request $request)
    {
        $this->validate($request, ['course_id' => 'required']);
        $courseId = $request->get('course_id');
        DB::transaction(function () use ($courseId) {
            $db = DB::connection('framework');
            try {
                $db->update(
                    'UPDATE courses SET subtitle=? WHERE id=?',
                    ['什么是教育云' . rand(), $courseId]
                );
                $chapters = $db->select(
                    'SELECT id FROM course_chapters WHERE courseId=?',
                    [$courseId]
                );
                if (count($chapters)) {
                    $array = ['接入教育云流程', '购买云视频', '使用云视频'];
                    $array = array_map(function ($value) {
                        return $value . mt_rand(111, 999);
                    }, $array);
                    foreach ($chapters as $key => $chapter) {
                        $db->update(
                            'UPDATE course_chapters SET title=? WHERE id=?',
                            [$array[$key], $chapter->id]
                        );
                    }
                }
            } catch (QueryException $exception) {
                return self::warningResponse([], $exception->getMessage());
            } catch (\Exception $exception) {
                return self::warningResponse([], $exception->getMessage());
            }
        });

        return self::successResponse([$request->all()], '数据更新成功');
    }

    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array
     */
    public function messages()
    {
        return [
            'title.required' => 'A title is required',
            'body.required'  => 'A message is required',
        ];
    }
}
