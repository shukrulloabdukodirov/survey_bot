<?php

namespace Base\Survey\Domain\Services;

use App\Services\BaseService;
use Base\Survey\Domain\Repositories\QuestionAnswerRepository;
use Base\Survey\Domain\Repositories\QuestionRepository;

class QuestionService extends BaseService
{
    public $questionRepository;
    public $questionAnswerRepository;

    public function __construct(QuestionRepository $questionRepository, QuestionAnswerRepository $questionAnswerRepository){
        $this->questionRepository = $questionRepository;
        $this->questionAnswerRepository = $questionAnswerRepository;
    }

    public function storeQuestion($request){
        $data = $this->questionRepository->create($this->load($request->except('answers')));
        if(!empty($data)){
            $input = $request->only('answers');
            if($input)
            {
                foreach ($input['answers'] as $answer){
                    $data->questionAnswers()->create($this->load(json_decode($answer, true)));
                }
            }
        }
        return $data;
    }

    public function updateQuestion($request, $id){
        $data = $this->questionRepository->update($this->load($request->except('answers')),$id);
        if(!empty($data)){
           $input = $request->only('answers');
           if($input)
           {
               foreach ($input['answers'] as $answer){
                    $answer=json_decode($answer, true);
                   $updateAnswer = $data->questionAnswers()->where('id',$answer['id'])->first();
                   if(!empty($updateAnswer)){
                       $updateAnswer->fill($this->load($answer))->update();
                   }
                   else{
                       $data->questionAnswers()->create($this->load($answer));
                   }
               }
           }
        }
        return $data;
    }
}
