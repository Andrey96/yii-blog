<?php

/**
 * Используется для ограничения доступа к аккаунту пользователя,
 * если несколько раз подряд введен неверный пароль.
 */
class UserProtector extends CComponent
{
	public $maxTries = 3;
	public $delay = 300; //5 минут

	public function init() { }

	private function getOrCreateAuth($user)
	{
		$auth = $user->auth;
		if (!$auth)
		{
			$auth = new Auth;
			$auth->userID = $user->id;
			$auth->fails = 0;
			$auth->lastTry = 0;
			$auth->save(false);
			$user->auth = $auth;
		}
		return $auth;
	}

	/**
	 * Возвращает сколько секунд пользователь должен подождать до следующей попытки авторизации.
	 * Если 0, то можно провести авторизацию прямо сейчас.
	 */
	public function tryToLogin($user)
	{
		$auth = $this->getOrCreateAuth($user);
		$wait = $this->delay - (time() - $auth->lastTry);
		if ($wait <= 0 && $auth->fails > 0) //если последняя попытка входа была более delay секунд назад и попытки не сброшены
		{
			//сбрасываем количество неудачных попыток
			$auth->fails = 0;
			$auth->save(false);
			return 0;
		}
		if ($auth->fails >= $this->maxTries)
		{
			return $wait;
		}
		return 0; //количество неудачных попыток еще не достигло максимума
	}

	/**
	 * Увеличивает количество неудачных попыток входа, если они не достигли максимума
	 */
	public function loginFailed($user)
	{
		$auth = $this->getOrCreateAuth($user);
		if ($fails < $this->maxTries)
		{
			$auth->fails++;
			$auth->lastTry = time();
			$auth->save(false);
		}
	}
}