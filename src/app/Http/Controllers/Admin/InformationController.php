<?php

namespace App\Http\Controllers\Admin;

use App\Commons\ConstantService;
use App\Rules\BetweenFromToDate;
use App\Rules\ExistBase;
use App\Services\Contracts\InformationContract as IfSv;
use Auth;
use Illuminate\Http\Request;
use Illuminate\Support\ViewErrorBag;
use Validator;

class InformationController extends AdminController
{
    /**
     * @var IfSv|null
     */
    protected $ifSv = null;

    /**
     * @author : Phi .
     * InformationController constructor.
     * @param IfSv $informationService
     */
    public function __construct(IfSv $informationService)
    {
        $this->ifSv = $informationService;
        parent::__construct();
    }

    /**
     * @author : Phi .
     * insert log to history table .
     */
    public function logAuthenticate()
    {
        // TODO: Change the autogenerated stub
        $actionText = 'お知らせ一覧画面を閲覧しました。';

        $rName = \request()->route()->getName();
        if ($rName == 'admin.info.registry') {
            $actionText = 'お知らせ新規登録画面を閲覧しました。';
        } elseif ($rName == 'admin.info.detail') {
            $id         = \request()->route('info_id');
            $info       = $this->ifSv->getById($id);
            $actionText = 'お知らせ「' . $info->info_title . '」を閲覧しました。';
        }

        $this->ifSv->adInsertLog($actionText);
    }

    /**
     * @author : Phi .
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index(Request $request)
    {
        $data   = $this->data;
        $params = $request->all();

        $data['title'] = __('ユーザー一覧 | 121 ROUND APP');
        /**
         * Breadcrumb .
         */
        $data['breadcrumb'] = [
            'name'  => 'admin_user_index',
            'title' => __('ユーザー一覧')
        ];

        $data['status'] = '';
        if (isset($params['status'])) {
            $data['status']                         = (int)$params['status'];
            $data[self::$textQueryString]['status'] = $params['status'];
        }

        $conditions = [];
        if (($data['status'] === 0) || ($data['status'] === 1)) {
            $conditions['status'] = $data['status'];
        }

        $results = $this->ifSv->adGetLists($conditions, $this->getLimit());

        $data[self::$textPerPage] = $this->_getTextPagination($results);
        $data[self::$textStartNo] = $this->getStartNo();
        $data[self::$textPaging]  = $results->appends($data[self::$textQueryString])->links();

        $data['lists'] = [];
        foreach ($results as $key => $result) {
            $data['lists'][] = [
                'id'         => $result->info_id,
                'title'      => $result->info_title,
                'baseName'   => '',
                'startDate'  => $result->start_date_text,
                'typeText'   => $result->type_text,
                'endDate'    => $result->end_date_text,
                'statusText' => $result->status_text,
                'hrefDetail' => $this->urlHttpBuildQuery('info/detail/' . $result->info_id, $params)
            ];
        }

        $data['registUrl'] = $this->urlHttpBuildQuery('info/regist', $params);

        $data['modal']['delete']['isShow'] = true;
        $data['modal']['delete']['href']   = route('admin.info.delete');

        $data['isMessageDelete'] = false;
        if (session()->get('errors') instanceof ViewErrorBag) {
            foreach (session()->get('errors')->messages() as $key => $value) {
                if ($key == 'action') {
                    $data['isMessageDelete'] = true;
                }
            }
        }

        $template = 'admin.informations.index';

        return view($template, $data);
    }

    /**
     * @author : Phi .
     * @param Request $request
     * @param null $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector|\Illuminate\View\View
     */
    public function detail(Request $request, $id = null)
    {
        $data   = $this->data;
        $errors = [];
        $info   = $this->ifSv->getById($id);

        $data['backUrl'] = $this->urlHttpBuildQuery('info');

        $formData = $info->toArray();
        if ($request->isMethod('post')
            && $this->__validate($formData, $errors)) {
            $this->__editExec($errors, $formData, $info);

            if (empty($errors)) {
                return redirect($this->_getSuccessPathRedirect('info'));
            }
        }

        $data['title'] = __('お知らせ詳細・編集 | 121 ROUND APP');
        /**
         * Breadcrumb .
         */
        $data['breadcrumb'] = [
            'name'        => 'admin_user_registry',
            'title'       => __('お知らせ詳細・編集'),
            'parentTitle' => 'お知らせ一覧'
        ];

        $data['info'] = [
            'id'           => $info->info_id,
            'type'         => $formData['type'],
            'baseId'       => $formData['base_id'],
            'infoTitle'    => $formData['info_title'],
            'infoContents' => $formData['info_contents'],
            'startDate'    => $formData['disp_start_date'],
            'endDate'      => $formData['disp_end_date']
        ];

        $data['submitForm'] = route('admin.info.detail', ['id' => $id]);

        $data['errors']    = $errors;
        $data['baseTypes'] = ConstantService::BASE_TYPE;
        $data['bases']     = [];

        /*if ($formData['type']) {
            $bases = $this->ifSv->getDropDownBase($formData['type']);
            foreach ($bases->cursor() as $base) {
                $data['bases'][] = [
                    'id'   => $base->base_id,
                    'name' => $base->base_name
                ];
            }
        }*/

        $data['modal']['js']['select2'] = true;

        return view('admin.informations.detail', $data);
    }

    /**
     * @author : Phi .
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector|\Illuminate\View\View
     */
    public function registry(Request $request)
    {
        $data   = $this->data;
        $errors = [];

        $data['backUrl'] = $this->urlHttpBuildQuery('info');

        $formData = [
            'type'            => null,
            'base_id'         => null,
            'info_title'      => null,
            'info_contents'   => null,
            'disp_start_date' => null,
            'disp_end_date'   => null
        ];
        if ($request->isMethod('post')
            && $this->__validate($formData, $errors)) {
            $this->__registryExec($errors, $formData);

            if (empty($errors)) {
                return redirect($this->_getSuccessPathRedirect('info'));
            }
        }

        $data['title'] = __('お知らせ登録 | 121 ROUND APP');
        /**
         * Breadcrumb .
         */
        $data['breadcrumb'] = [
            'name'        => 'admin_info_registry',
            'title'       => __('お知らせ登録'),
            'parentTitle' => 'お知らせ一覧'
        ];

        $data['formData']  = $formData;
        $data['errors']    = $errors;
        $data['baseTypes'] = ConstantService::BASE_TYPE;
        $data['bases']     = [];
        if ($formData['type']) {
            $bases = $this->ifSv->getDropDownBase($formData['type']);
            foreach ($bases->cursor() as $base) {
                $data['bases'][] = [
                    'id'   => $base->base_id,
                    'name' => $base->base_name
                ];
            }
        }

        $data['modal']['js']['select2'] = true;

        return view('admin.informations.registry', $data);
    }

    /**
     * @author : Phi .
     * @param Request $request
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector|\Illuminate\View\View
     */
    public function detail_2(Request $request, $id)
    {
        $data   = $this->data;
        $errors = [];
        $info   = $this->ifSv->getById($id);

        $data['backUrl'] = $this->urlHttpBuildQuery('info');

        $formData = $info->toArray();
        $config   = $this->ifSv->getSettingUser();

        $formData['type'] = $config['information.type'];
        if ($request->isMethod('post')
            && $this->__validate_2($formData, $errors)) {
            $this->__editExec($errors, $formData, $info);

            if (empty($errors)) {
                return redirect($this->_getSuccessPathRedirect('info'));
            }
        }

        $data['title'] = __('お知らせ詳細・編集 | 121 ROUND APP');
        /**
         * Breadcrumb .
         */
        $data['breadcrumb'] = [
            'name'        => 'admin_info_registry',
            'title'       => __('お知らせ詳細・編集'),
            'parentTitle' => 'お知らせ一覧'
        ];

        $data['info'] = [
            'id'           => $info->info_id,
            'type'         => $formData['type'],
            'baseId'       => $formData['base_id'],
            'infoTitle'    => $formData['info_title'],
            'infoContents' => $formData['info_contents'],
            'startDate'    => $formData['disp_start_date'],
            'endDate'      => $formData['disp_end_date']
        ];

        $data['submitForm'] = route('admin.info.detail', ['id' => $id]);

        $data['errors'] = $errors;
        $data['bases']  = [];

        $bases = $this->ifSv->getDropDownBase($formData['type']);
        foreach ($bases->cursor() as $base) {
            $data['bases'][] = [
                'id'   => $base->base_id,
                'name' => $base->base_name
            ];
        }

        $data['modal']['js']['select2'] = true;

        return view('admin.informations.detail2', $data);
    }

    /**
     * @author : Phi .
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector|\Illuminate\View\View
     */
    public function registry_2(Request $request)
    {
        $data   = $this->data;
        $errors = [];

        $data['backUrl'] = $this->urlHttpBuildQuery('info');

        $config   = $this->ifSv->getSettingUser();
        $formData = [
            'type'            => $config['information.type'],
            'base_id'         => null,
            'info_title'      => null,
            'info_contents'   => null,
            'disp_start_date' => null,
            'disp_end_date'   => null
        ];
        if ($request->isMethod('post')
            && $this->__validate_2($formData, $errors)) {
            $this->__registryExec($errors, $formData);

            if (empty($errors)) {
                return redirect($this->_getSuccessPathRedirect('info'));
            }
        }

        $data['title'] = __('お知らせ登録 | 121 ROUND APP');
        /**
         * Breadcrumb .
         */
        $data['breadcrumb'] = [
            'name'        => 'admin_info_registry',
            'title'       => __('お知らせ登録'),
            'parentTitle' => 'お知らせ一覧'
        ];

        $data['formData'] = $formData;
        $data['errors']   = $errors;

        $bases = $this->ifSv->getDropDownBase($formData['type']);
        foreach ($bases->cursor() as $base) {
            $data['bases'][] = [
                'id'   => $base->base_id,
                'name' => $base->base_name
            ];
        }

        $data['modal']['js']['select2'] = true;

        return view('admin.informations.registry2', $data);
    }

    /**
     * @author : Phi .
     * @param $errors
     * @param $formData
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    private function __registryExec(&$errors, &$formData)
    {
        try {
            $this->ifSv->adInsert($formData);

        } catch (\PDOException $e) {
            $errors['db_error'][] = $e->getMessage();
        } catch (\Exception $e) {
            $errors['db_error'][] = $e->getMessage();
        }
    }

    /**
     * @author : Phi .
     * @param $formData
     * @param $errors
     * @return bool
     */
    private function __validate(&$formData, &$errors)
    {
        $r = \request()->all();

        $formData['type'] = isset($r['type']) ? $r['type'] : $formData['type'];

        $formData['base_id'] = (isset($r['base_id']) && $r['base_id']) ? $r['base_id'] : $formData['base_id'];

        $formData['info_title'] = isset($r['info_title']) ? $r['info_title'] : $formData['info_title'];

        $formData['info_contents'] = isset($r['info_contents']) ? $r['info_contents'] : $formData['info_contents'];

        $formData['disp_start_date'] = isset($r['disp_start_date']) ? $r['disp_start_date'] : $formData['disp_start_date'];

        $formData['disp_end_date'] = isset($r['disp_end_date']) ? $r['disp_end_date'] : $formData['disp_end_date'];

        $validator = Validator::make($formData, [
            'base_id'         => ['present', 'nullable', new ExistBase()],
            'info_title'      => 'required|string|max:100',
            'info_contents'   => ['required', 'string', 'max:500'],
            'disp_start_date' => ['required', 'date', new BetweenFromToDate($formData['disp_end_date'])],
            'disp_end_date'   => ['present', 'nullable', 'date']
        ], []);

        $this->_setFormatError($validator, $errors);

        if (!empty($errors)) {
            return false;
        } else {
            return true;
        }
    }

    /**
     * @author : Phi .
     * @param $errors
     * @param $formData
     * @param $info
     */
    private function __editExec(&$errors, &$formData, &$info)
    {
        try {
            $this->ifSv->adUpdate($formData, $info);

        } catch (\PDOException $e) {
            $errors['db_error'][] = $e->getMessage();
        } catch (\Exception $e) {
            $errors['db_error'][] = $e->getMessage();
        }
    }

    /**
     * @author : Phi .
     * @param $formData
     * @param $errors
     * @return bool
     */
    private function __validate_2(&$formData, &$errors)
    {
        $r = \request()->all();

        $formData['base_id'] = (isset($r['base_id']) && $r['base_id']) ? $r['base_id'] : $formData['base_id'];

        $formData['info_title'] = isset($r['info_title']) ? $r['info_title'] : $formData['info_title'];

        $formData['info_contents'] = isset($r['info_contents']) ? $r['info_contents'] : $formData['info_contents'];

        $formData['disp_start_date'] = isset($r['disp_start_date']) ? $r['disp_start_date'] : $formData['disp_start_date'];

        $formData['disp_end_date'] = isset($r['disp_end_date']) ? $r['disp_end_date'] : $formData['disp_end_date'];

        $validator = Validator::make($formData, [
            'base_id'         => ['present', 'nullable', new ExistBase()],
            'info_title'      => 'required|string|max:100',
            'info_contents'   => ['required', 'string', 'max:500'],
            'disp_start_date' => ['required', 'date', new BetweenFromToDate($formData['disp_end_date'])],
            'disp_end_date'   => ['present', 'nullable', 'date']
        ], []);

        $this->_setFormatError($validator, $errors);

        if (!empty($errors)) {
            return false;
        } else {
            return true;
        }
    }

    /**
     * @author : Phi .
     * @param Request $request
     * @return $this
     */
    public function delete(Request $request)
    {
        $errors   = [];
        $formData = $request->all();

        $id   = isset($formData['info_id']) ? $formData['info_id'] : null;
        $info = $this->ifSv->getById($id);

        try {

            $info->delete();

        } catch (\PDOException $e) {
            $errors['db_error'][] = $e->getMessage();
        } catch (\Exception $e) {
            $errors['db_error'][] = $e->getMessage();
        }

        if (empty($errors)) {
            $errors['action'] = [
                'status' => 2000,
                'name'   => 'delete'
            ];
        }

        return back()->withErrors($errors)->withInput();
    }
}
