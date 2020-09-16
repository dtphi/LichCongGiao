<?php
/**
 * Created by PhpStorm.
 * User: Phi
 * Date: 7/2/2019
 * Time: 9:16 AM
 */

use App;
use Auth;
use Illuminate\Support\Carbon;
use Illuminate\Support\Str;

defined('DS') || define('DS', DIRECTORY_SEPARATOR);

if (!function_exists('get_file_name')) {
    /**
     * @author : Phi .
     * @param $file
     * @return string
     */
    function get_file_name(&$file)
    {
        $fileName = pathinfo($file->getClientOriginalName(),PATHINFO_FILENAME);

        $hash = $fileName ? $fileName = $fileName . '_' . time(): $fileName = Str::random(40);

        if ($extension = $file->guessExtension()) {
            $extension = '.'.$extension;
        }

        return $hash.$extension;
    }
}

if (!function_exists('get_movie_dir_s3')) {
    /**
     * @author : Phi .
     * @return \Illuminate\Config\Repository|mixed
     */
    function get_movie_dir_s3()
    {
        return config('filesystems.disks.s3.movie_dir');
    }
}

if (!function_exists('get_pouch_dir_s3')) {
    /**
     * @author : Phi .
     * @return \Illuminate\Config\Repository|mixed
     */
    function get_pouch_dir_s3()
    {
        return config('filesystems.disks.s3.pouch_dir');
    }
}

if (!function_exists('get_script_dir_s3')) {
    /**
     * @author : Phi .
     * @return \Illuminate\Config\Repository|mixed
     */
    function get_script_dir_s3()
    {
        return config('filesystems.disks.s3.script_dir');
    }
}

if (!function_exists('get_credo_dir_s3')) {
    /**
     * @author : Phi .
     * @return \Illuminate\Config\Repository|mixed
     */
    function get_credo_dir_s3()
    {
        return config('filesystems.disks.s3.credo_dir');
    }
}

if (!function_exists('view_pdf_s3')) {
    /**
     * @author : Phi .
     * @param $path
     * @return \Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Http\Response
     */
    function view_pdf_s3($path)
    {
        $s3Cloud = \Illuminate\Support\Facades\Storage::cloud();
        $s3Url   = $s3Cloud->url($path);

        if ($s3Cloud->exists($path)) {
            return response(file_get_contents($s3Url), \Symfony\Component\HttpFoundation\Response::HTTP_OK, [
                'Content-Type'        => 'application/pdf',
                'Content-Disposition' => 'inline; filename="' . $path . '"'
            ]);
        }

        return response('', \Symfony\Component\HttpFoundation\Response::HTTP_INTERNAL_SERVER_ERROR, [
            'Content-Type'        => 'application/pdf',
            'Content-Disposition' => 'inline; filename="' . $path . '"'
        ]);
    }
}

if (!function_exists('view_s3_url')) {
    /**
     * @author : Phi .
     * @param $path
     * @return \Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Http\Response
     */
    function view_s3_url($path)
    {
        $s3Cloud = \Illuminate\Support\Facades\Storage::cloud();
        $s3Url   = $s3Cloud->url($path);

        if ($s3Cloud->exists($path)) {
            return $s3Url;
        }

        return response('', \Symfony\Component\HttpFoundation\Response::HTTP_INTERNAL_SERVER_ERROR, [
            'Content-Type'        => 'application/pdf',
            'Content-Disposition' => 'inline; filename="' . $path . '"'
        ]);
    }
}

if (!function_exists('get_personal_access_client_id')) {
    /**
     * @author : Phi .
     * @return \Illuminate\Config\Repository|mixed
     */
    function get_personal_access_client_id()
    {
        $clientId = config('app.pac_id');
        if (!$clientId) {
            $p = \DB::table('oauth_personal_access_clients')
                ->join('oauth_clients', 'oauth_clients.id', '=', 'oauth_personal_access_clients.client_id')
                ->where('oauth_clients.personal_access_client', 1)
                ->select('oauth_personal_access_clients.client_id')
                ->first();

            if (isset($p->client_id)) {
                $clientId = $p->client_id;
            }
        }

        return $clientId;
    }
}

if (!function_exists('date_ymd_hms')) {
    /**
     * author : Phi.
     * @param string $strDate
     * @param string $format
     * @return string
     */
    function date_ymd_hms($strDate = '', $format = '')
    {
        try {
            $c = Carbon::parse($strDate);

            if (empty($format)) {

                $y = $c->get('year');
                $m = $c->get('month');
                $d = $c->get('day');

                return $y . '/' . str_pad($m, 2, '0', STR_PAD_LEFT) . '/' . str_pad($d, 2, '0', STR_PAD_LEFT);
            } else {
                if ($format == 'Y-m-d') {
                    return $c->toDateString();
                } elseif ($format == 'H:m:s') {
                    return $c->toTimeString();
                } elseif ($format == 'H:m') {
                    $h = $c->get('hour');
                    $m = $c->get('minute');

                    return str_pad($h, 2, '0', STR_PAD_LEFT) . ':' . str_pad($m, 2, '0', STR_PAD_LEFT);
                }
            }

        } catch (\Exception $e) {
            $strDate = '';
        }

        return $strDate;
    }
}

if (!function_exists('date_ymd')) {
    /**
     * author : Phi.
     * @param string $strDate
     * @param string $format
     * @return string
     */
    function date_ymd($strDate = '', $format = '')
    {
        try {
            $c       = new Carbon($strDate);
            $strDate = $c->format(empty($format) ? 'Y/m/d' : $format);
        } catch (\Exception $e) {
            $strDate = '';
        }

        return $strDate;
    }
}

if (!function_exists('date_time_string_start')) {
    /**
     * author : Phi.
     * @param string $strDate
     * @return string
     */
    function date_time_string_start($strDate = '')
    {
        try {
            $strDate = Carbon::parse($strDate)
                ->startOfDay()
                ->toDateTimeString();
        } catch (\Exception $e) {
            $strDate = '';
        }

        return $strDate;
    }
}

if (!function_exists('date_time_string_end')) {
    /**
     * author : Phi.
     * @param string $strDate
     * @return string
     */
    function date_time_string_end($strDate = '')
    {
        try {
            $strDate = Carbon::parse($strDate)
                ->endOfDay()
                ->toDateTimeString();
        } catch (\Exception $e) {
            $strDate = '';
        }

        return $strDate;
    }
}

if (!function_exists('member_event_registry_data')) {
    /**
     * author : Phi.
     * @param $data
     * @return mixed
     */
    function member_event_registry_data(&$data)
    {
        $env = config('app.env');
        if ($env == 'dev') {
            $data['title']                         = 1;
            $data['memberCourse']                  = 1;
            $data['companionName']                 = '山田　太郎';
            $data['companionFurigana']             = '同伴者フリガナ';
            $data['companionTel']                  = '00000000001';
            $data['companionAverageOrCurrenthdcp'] = 1;
            $data['companionParticipationHistory'] = 2;
            $data['companionAge']                  = 30;
            $data['companionGender']               = 1;
            $data['companionPostalcode']           = '111-1111';
            $data['companionPrefecture']           = '同伴者都道府県任意';
            $data['companionAddress1']             = '同伴者市区町村';
            $data['companionAddress2']             = '同伴者町名番地等';
            $data['companionAddress3']             = '同伴者建物名';
            $data['payment']                       = 1;
            $data['hopeSameTeam']                  = 1;
            $data['hopeSameTeamOther']             = '同組希望者';
        }

        $errors = session()->get('errors');
        if (!empty($errors)) {
            print_r($errors);
        }

        return $data;
    }
}

if (!function_exists('credit_card_year')) {
    /**
     * author : Phi .
     * @param int $rank
     * @return array
     */
    function credit_card_year($rank = 6)
    {
        $curYear   = Carbon::now()->format('y');
        $arrYear[] = $curYear;

        if ($rank) {
            for ($i = 1; $i <= $rank; $i++) {
                array_push($arrYear, $curYear + $i);
            }
        }

        return $arrYear;
    }
}

if (!function_exists('current_time_stamp')) {
    /**
     * @author : Phi .
     * @return string
     */
    function current_time_stamp()
    {
        $curTimeStamp = Carbon::now()->toDateTimeString();

        return $curTimeStamp;
    }
}

if (!function_exists('get_max_time_stamp')) {
    /**
     * @author : Phi .
     * @param string|float|int $max
     * @return int|false
     */
    function get_max_time_stamp($max = 'now')
    {
        if (is_numeric($max)) {
            return (int)$max;
        }

        if ($max instanceof \DateTime) {
            return $max->getTimestamp();
        }

        return strtotime(empty($max) ? 'now' : $max);
    }
}

if (!function_exists('get_date_time_stamp')) {
    /**
     * @author : Phi .
     * @param string|float|int $max
     * @return int|false
     */
    function get_date_time_stamp($max = '')
    {
        if (is_numeric($max)) {
            return (int)$max;
        }

        if ($max instanceof \DateTime) {
            return $max->getTimestamp();
        }

        return strtotime(empty($max) ? Carbon::now()->format('Y-m-d') : $max);
    }
}

if (!function_exists('get_env_url')) {
    /**
     * author : Phi.
     * @param string $type
     * @return \Illuminate\Config\Repository|mixed|string
     */
    function get_env_url($type = 'domain')
    {
        $url = url('/');

        $http        = env('DOMAIN_HTTP', 'https://');
        $domain      = $http . env('DOMAIN_MEMBER', 'member.hare.club');
        $domainAdmin = $http . env('DOMAIN_ADMIN', 'admin.hare.club');
        $appUrl      = env('APP_URL', $http . 'hare.club');

        if (App::environment(['local', 'dev'])) {
            $http        = config('app.domain.http');
            $domain      = $http . config('app.domain.member');
            $domainAdmin = $http . config('app.domain.admin');

            if (config('app.domain.port')) {
                $domain      = $domain . ':' . config('app.domain.port');
                $domainAdmin = $domainAdmin . ':' . config('app.domain.port');
            }

            $appUrl = config('app.url');
        }

        switch ($type) {
            case 'domain':

                return $domain;

            case 'domain.admin':

                return $domainAdmin;

            case 'app.url':

                return $appUrl;
        }

        return $url;
    }
}

if (!function_exists('get_env_domain')) {
    /**
     * author : Phi.
     * @param string $type
     * @return \Illuminate\Config\Repository|mixed
     */
    function get_env_domain($type = 'member')
    {
        $domain      = env('DOMAIN_MEMBER');
        $domainApp   = env('DOMAIN_APP');
        $domainAdmin = env('DOMAIN_ADMIN');

        if (App::environment(['local', 'dev'])) {
            $domain      = config('app.domain.member');
            $domainApp   = config('app.domain.app');
            $domainAdmin = config('app.domain.admin');
        }

        switch ($type) {
            case 'app':
                return $domainApp;

            case 'member':
                return $domain;

            case 'admin':
                return $domainAdmin;
        }
    }
}

if (!function_exists('get_limit')) {
    /**
     * @author : Phi .
     * @return \Illuminate\Config\Repository|int|mixed
     */
    function get_limit()
    {
        if (env('APP_LIMIT')) {
            return env('APP_LIMIT');
        }
        if (config('app.limit')) {
            return config('app.limit');
        }

        return 20;
    }
}

if (!function_exists('get_years')) {
    /**
     * @author : Phi .
     * @return \Illuminate\Config\Repository|int|mixed
     */
    function get_years()
    {
        $start = 1900;
        $end   = Carbon::now()->year;

        $years = [];
        for ($i = $start; $i <= $end; $i++) {
            $years[] = $i;
        }

        return $years;
    }
}

if (!function_exists('get_img_url')) {
    /**
     * author : Phi.
     * @param $filePath
     * @return \Illuminate\Contracts\Routing\UrlGenerator|string
     */
    function get_img_url($filePath)
    {
        $imgUrl = url('img/no-image.png');
        if (file_exists(public_path($filePath))) {
            $imgUrl = url($filePath);
        }

        return $imgUrl;
    }
}

if (!function_exists('get_pass')) {
    /**
     * author : Phi.
     * @param $password
     * @return mixed
     */
    function get_pass($password)
    {
        return Hash::make($password);
    }
}

if (!function_exists('get_start_date')) {
    /**
     * @author : Matsuda .
     * @return \Illuminate\Config\Repository|int|mixed
     */
    function get_start_date()
    {
        $start_hour = 5;
        $end_hour   = 17;

        $i = 0;
        for ($i = $start_hour; $i <= $end_hour; $i++) {
            $hours[$i] = $i;
        }

        return $hours;
    }
}

if (!function_exists('get_minutes')) {
    /**
     * @author : Phi .
     * @return \Illuminate\Config\Repository|int|mixed
     */
    function get_minutes()
    {
        $max = 60;

        $i = 0;
        for ($i = 1; $i <= $max; $i++) {
            $minutes[$i] = $i;
        }

        return $minutes;
    }
}

if (!function_exists('get_sys_to_mail_env')) {
    /**
     * @author : Phi .
     * @return \Illuminate\Config\Repository|mixed
     */
    function get_sys_to_mail_env()
    {
        $mail = config('mail.from.address') ?? env('MAIL_FROM_ADDRESS');

        if (App::environment(['local', 'dev'])) {
            $mail = config('mail.from.local_address');
        }

        return $mail;
    }
}

if (!function_exists('get_setting_url')) {
    /**
     * @author : Phi .
     * @return \Illuminate\Config\Repository|mixed
     */
    function get_setting_url()
    {
        $user = Auth::user();

        $url = App\Http\Middleware\RedirectIfAuthenticated::RedirectSettingPassTo;
        if ($user->invalid_email == 1) {
            $url = App\Http\Middleware\RedirectIfAuthenticated::RedirectSettingTo;
        }

        return $url;
    }
}
