<?php

namespace App\Http\Controllers\Admin;

use App\Http\Middleware\RedirectIfAdminAuthenticated;
use App\Http\Utils\ActionHistory;
use App\Http\Utils\BackUrl;
use App\Http\Utils\Download;
use App\Http\Utils\Paginator;
use Auth;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class AdminController extends Controller
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests, ActionHistory, Download, Paginator, BackUrl;

    /**
     * @var string
     */
    protected $guard = 'admin';

    /**
     * @var int
     */
    protected $userType = 2;

    /**
     * @var int
     */
    protected $limit = 20;

    /**
     * @var array
     */
    protected $data = [];

    /**
     * @var string
     */
    public static $kindSession = 'session';

    /**
     * @var string
     */
    public static $textTitle = 'title';

    /**
     * @var string
     */
    public static $textLangCommon = 'lg';

    /**
     * @var string
     */
    public static $textLangAction = 'lgDir';

    /**
     * @var string
     */
    public static $textLimit = 'limit';

    /**
     * @var string
     */
    public static $textPaging = 'pagination';

    /**
     * @var string
     */
    public static $textBreadcrumb = 'breadcrumb';

    /**
     * @var string
     */
    public static $textKeyword = 'keyword';

    /**
     * @var string
     */
    public static $textDescription = 'description';

    /**
     * @var string
     */
    protected $imgPath = '/';

    /**
     * @var string
     */
    protected $noImage = '/img/admin/no_image.png';

    /**
     * @author : Phi .
     * Controller constructor.
     */
    public function __construct()
    {
        $this->guard = RedirectIfAdminAuthenticated::AdminGuard;
        Auth::shouldUse($this->guard);
        $this->_init();
    }

    /**
     * @author : Phi.
     * @return int app limit .
     */
    public function getLimit()
    {
        return $this->limit;
    }

    /**
     * @author : Phi .
     * @param Validator $validator
     * @param $errors
     * @return array
     */
    protected function _setFormatError($validator, &$errors)
    {
        if ($validator->fails()) {
            foreach ($validator->errors()->messages() as $key => $value) {
                if (is_array($value)) {
                    foreach ($value as $k => $error) {
                        $errors[$key . '_error'][] = $error;
                    }
                } else {
                    $errors[$key . '_error'][] = $value;
                }
            }
        }

        return $errors;
    }

    /**
     * @author : Phi .
     * Init controller .
     */
    private function _init()
    {
        $this->limit                        = get_limit();
        $this->data['noImage']              = $this->noImage;
        $this->data['userType']             = $this->userType;
        $this->data[self::$textLangCommon]  = 'common.';
        $this->data[self::$textLangAction]  = 'admin/';
        $this->data[self::$textLimit]       = $this->getLimit();
        $this->data[self::$textPerPage]     = '';
        $this->data[self::$textPaging]      = '';
        $this->data[self::$textBreadcrumb]  = [
            'name'  => 'dashboard',
            'title' => __('common.txt_home'),
            'id'    => ''
        ];
        $this->data[self::$textQueryString] = [];
        $this->data[self::$textTitle]       = '121チャンネル';
        $this->data[self::$textKeyword]     = '#{keyword}';
        $this->data[self::$textDescription] = '#{description}';
        $this->data[self::$textStartNo]     = 1;
        $this->data['modal']                = [
            'delete' => [
                'isShow' => false,
                'href'   => url('delete/')
            ],
            'video'  => [
                'isShow'     => false,
                'modalClass' => 'fade modal modal-movie'
            ],
            'js'     => [
                'select2'    => false,
                'summernote' => false,
                'yubinbango' => false
            ]
        ];
        $this->data[self::$strQuery]        = '';
    }

    /**
     * @author : Phi .
     * @param Request $request
     * @return mixed
     */
    public function indexMiddlewareUser(Request $request)
    {
        $user = Auth::user();

        switch ($user->type) {
            case 2:
                return $this->index_2($request);
                break;
            case 3:
                return $this->index_3($request);
                break;
            default:
                return $this->index($request);
                break;
        }

        return $this->index($request);
    }

    /**
     * @author : Phi .
     * @param Request $request
     * @return mixed
     */
    public function registryMiddlewareUser(Request $request)
    {
        $user = Auth::user();

        switch ($user->type) {
            case 2:
                return $this->registry_2($request);
                break;
            case 3:
                return $this->registry_3($request);
                break;
            default:
                return $this->registry($request);
                break;
        }

        return $this->registry($request);
    }

    /**
     * @author : Phi .
     * @param Request $request
     * @param null $id
     * @return mixed
     */
    public function detailMiddlewareUser(Request $request, $id = null)
    {
        $user = Auth::user();
        $this->_setCurBackUrl('admin.user.index');

        switch ($user->type) {
            case 2:
                return $this->detail_2($request, $id);
                break;
            case 3:
                return $this->detail_3($request, $id);
                break;
            default:
                return $this->detail($request, $id);
                break;
        }

        return $this->detail($request, $id);
    }

    /**
     * @author : Phi .
     * @param Request $request
     * @return mixed
     */
    public function registryMiddlewareInfo(Request $request)
    {
        $user = Auth::user();
        $this->_setCurBackUrl('admin.info.index');

        switch ($user->type) {
            case 2:
                return $this->registry_2($request);
                break;
            default:
                return $this->registry($request);
                break;
        }

        return $this->registry($request);
    }

    /**
     * @author : Phi .
     * @param Request $request
     * @param null $id
     * @return mixed
     */
    public function detailMiddlewareInfo(Request $request, $id = null)
    {
        $user = Auth::user();
        $this->_setCurBackUrl('admin.info.index');

        switch ($user->type) {
            case 2:
                return $this->detail_2($request, $id);
                break;
            default:
                return $this->detail($request, $id);
                break;
        }

        return $this->detail($request, $id);
    }
}
