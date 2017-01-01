<?php

namespace App\Modules\System\Observers;

use Nova\Support\Facades\Auth;

use App\Modules\System\Models\Log as ActionLog;


class UserActionsObserver
{
    public function saved($model)
    {
        if (Auth::check()) {
            $user = Auth::user();

            if ($model->wasRecentlyCreated == true) {
                // Data was just created
                $action = 'created';
            } else {
                // Data was updated
                $action = 'updated';
            }

            ActionLog::create(array(
                'user_id'      => $user->getKey(),
                'group_id'     => 2,
                'message'      => $this->message($model, $action),
            ));
        }
    }

    public function deleting($model)
    {
        if (Auth::check()) {
            $user = Auth::user();

            ActionLog::create(array(
                'user_id'      => $user->getKey(),
                'group_id'     => 2,
                'message'      => $this->message($model, 'deleted'),
            ));
        }
    }

    protected function message($model, $action)
    {
        return __d('system', 'Was {0} the <b>{1}</b> instance with <b>ID: {2}</b>', $action, get_class($model), $model->getKey());
    }
}
