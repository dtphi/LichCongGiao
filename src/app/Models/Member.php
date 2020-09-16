<?php

namespace App\Models;

use App\Commons\BaseModel as Model;
use App\Commons\ConstantService;
use App\Constants\Tables;

class Member extends Model
{
    /**
     * @var string
     */
    protected $table = Tables::Users;

    /**
     * @var string
     */
    protected $primaryKey = 'user_id';

    /**
     * @var string
     */
    public $timeFormat = 'H:m';

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function userExams()
    {
        return null;
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function base()
    {
        return null;
    }

    /**
     * @author : Phi .
     * @param $value
     * @return mixed
     */
    public function getOrgTextAttribute($value)
    {
        $orgs = ConstantService::ORG_TEXT;

        if (isset($orgs[$this->organization_id])) {
            $value = $orgs[$this->organization_id];

        }

        return $value;
    }

    /**
     * @author : Phi .
     * @param $value
     * @return mixed
     */
    public function getPassedTextAttribute($value)
    {
        if ($this->type == ConstantService::USER_TYPE_ADMIN || $this->type == ConstantService::USER_TYPE_GUEST) {
            $value = '-';
        } elseif ($this->type == ConstantService::USER_TYPE_MEMBER || $this->type == ConstantService::USER_TYPE_MEMBER_APP) {
            $value = '未受験';
        }

        $results = $this->userExams->groupBy('exam_id', 'base_id');

        $exams = [];
        foreach ($results as $result) {
            $exam = $result->first()->exam;
            if (!is_null($exam) && $exam->basic_exam == 1) {
                $exams[] = $exam;
            }
        }

        $exam = collect($exams)->sortByDesc('created_at')->first();

        if ($exam) {
            $userExam = $this->userExams->where('exam_id', $exam->exam_id)->first();

            if (ConstantService::EXAM_PASSED[$userExam->passed]) {
                $value = ConstantService::EXAM_PASSED[$userExam->passed];
            }
        }

        return $value;
    }

    /**
     * @author : Phi .
     * @param $value
     * @return mixed
     */
    public function getDownPassedTextAttribute($value)
    {
        $pass = ConstantService::EXAM_PASSED;

        $value = $pass[$this->passed];

        return $value;
    }

    /**
     * @author : Phi .
     * @param $value
     * @return mixed
     */
    public function getBaseTypeTextAttribute($value)
    {
        if ($this->base instanceof Base) {
            $value = $this->base->type_text;

        }

        return $value;
    }

    /**
     * @author : Phi .
     * @param $query
     * @param string $nameKana
     * @return mixed
     */
    public function scopeFilterLikeKana($query, $nameKana = '')
    {
        if (!empty($nameKana)) {
            return $query->where($this->table . '.name_kana', 'LIKE', '%' . $nameKana . '%');
        }

        return $query;
    }

    /**
     * @author : Phi .
     * @param $query
     * @param string $email
     * @return mixed
     */
    public function scopeFilterLikeEmail($query, $email = '')
    {
        if (!empty($email)) {
            return $query->where($this->table . '.email', 'LIKE', '%' . $email . '%');
        }

        return $query;
    }

    /**
     * @author : Phi .
     * @param $query
     * @param string $id
     * @return mixed
     */
    public function scopeFilterOrgById($query, $id = '')
    {
        if (!empty($id)) {
            return $query->where($this->table . '.organization_id', $id);
        }

        return $query;
    }

    /**
     * @author : Phi .
     * @param $query
     * @param string $id
     * @return mixed
     */
    public function scopeFilterBaseById($query, $id = '')
    {
        if (!empty($id)) {
            return $query->where($this->table . '.base_id', $id);
        }

        return $query;
    }

    /**
     * @author : Phi .
     * @param $query
     * @return mixed
     */
    public function scopeFilterMemberType($query)
    {
        return $query->whereIn($this->table . '.type', ConstantService::LIST_MEMBER_TYPE_SHOW);
    }

    /**
     * @author : Phi .
     * @param $query
     * @param null $examId
     * @param int $pass
     * @return mixed
     */
    public function scopeLJoinUserExams($query, $examId = null, $pass = 0)
    {
        if ($pass) {
            $query->where(Tables::User_Exams . '.passed', $pass);
        }

        $query->leftjoin(Tables::User_Exams, function ($join) {
            $join->on(Tables::User_Exams . '.user_id', '=',
                $this->table . '.user_id');
        })->groupBy(Tables::User_Exams . '.user_id', Tables::User_Exams . '.exam_id')
            ->where(Tables::User_Exams . '.exam_id', $examId);

        return $query;
    }

    /**
     * @author : Phi .
     * @param $query
     * @return mixed
     */
    public function scopeLJoinBase($query)
    {
        $query->leftjoin(Tables::Bases, function ($join) {
            $join->on(Tables::Bases . '.base_id', '=',
                $this->table . '.base_id')->whereNull(Tables::Bases . '.deleted_at');
        });

        return $query;
    }
}
