<?php

namespace App\Policies;

use App\User;
use App\ChallengeParentStep;
use Illuminate\Auth\Access\HandlesAuthorization;

class ChallengeParentStepPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view the challenge parent step.
     *
     * @param  \App\User  $user
     * @param  \App\ChallengeParentStep  $challengeParentStep
     * @return mixed
     */
     // ログインしているユーザーとチャレンジ中のユーザーが一致するかの確認
    public function show(User $user, ChallengeParentStep $challengeParentStep)
    {
        return $user->id == $challengeParentStep->user_id;
    }


    /**
     * Determine whether the user can update the challenge parent step.
     *
     * @param  \App\User  $user
     * @param  \App\ChallengeParentStep  $challengeParentStep
     * @return mixed
     */
    public function clear(User $user, ChallengeParentStep $challengeParentStep)
    {
      return $user->id == $challengeParentStep->user_id;

    }

    /**
     * Determine whether the user can delete the challenge parent step.
     *
     * @param  \App\User  $user
     * @param  \App\ChallengeParentStep  $challengeParentStep
     * @return mixed
     */
    public function delete(User $user, ChallengeParentStep $challengeParentStep)
    {
        //
    }

    /**
     * Determine whether the user can restore the challenge parent step.
     *
     * @param  \App\User  $user
     * @param  \App\ChallengeParentStep  $challengeParentStep
     * @return mixed
     */
    public function restore(User $user, ChallengeParentStep $challengeParentStep)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the challenge parent step.
     *
     * @param  \App\User  $user
     * @param  \App\ChallengeParentStep  $challengeParentStep
     * @return mixed
     */
    public function forceDelete(User $user, ChallengeParentStep $challengeParentStep)
    {
        //
    }
}
