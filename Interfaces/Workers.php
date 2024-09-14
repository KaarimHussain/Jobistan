<?php
interface IWorker
{
    public function fetchWorkerExperience($user_id);
    public function fetchWorkerSkills($user_id);
    public function fetchWorkerProjectLinks($user_id);
    public function fetchWorkerPortfolioLink($user_id);
    public function fetchUserAdditionalInfo($user_id);
    public function checkWorkerViewExistWithCompanyID($company_id, $user_id);
}
