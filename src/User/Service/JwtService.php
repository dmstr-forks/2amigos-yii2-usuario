<?php

/*
 * This file is part of the 2amigos/yii2-usuario project.
 *
 * (c) 2amigOS! <http://2amigos.us/>
 *
 * For the full copyright and license information, please view
 * the LICENSE file that was distributed with this source code.
 */

namespace Da\User\Service;

use Da\User\Model\User;
use Da\User\Traits\ModuleAwareTrait;
use DateTimeImmutable;
use Lcobucci\JWT\UnencryptedToken;
use Yii;
use yii\base\Component;
use yii\base\InvalidConfigException;

/**
 * JWT Service for handling JWT token operations
 */
class JwtService extends Component
{
    use ModuleAwareTrait;

    /**
     * @var string|null JWT component name in Yii::$app
     */
    public $jwtComponent = 'jwt';

    /**
     * @var bool Whether JWT functionality is enabled
     */
    public $enabled = true;

    /**
     * Generate a JWT token for the given user
     *
     * @param User $user
     * @param callable|null $config
     * @return UnencryptedToken|null
     * @throws InvalidConfigException
     */
    public function generateToken(User $user, ?callable $config = null): ?UnencryptedToken
    {
        if (!$this->enabled || !$this->isJwtComponentAvailable()) {
            Yii::info('JWT token generation skipped - service disabled or component unavailable');
            return null;
        }

        try {
            $now = DateTimeImmutable::createFromFormat('U', time());
            /** @var \bizley\jwt\Jwt $jwt */
            $jwt = Yii::$app->get($this->jwtComponent);
            $builder = $jwt->getBuilder()
                ->issuedAt($now)
                ->relatedTo($user->uuid);

            if (is_callable($config)) {
                $builder = $config($builder);
            } else {
                $module = $this->getModule();
                $expiresAtModifier = $module->jwtTokenExpiration;
                $issuer = $module->jwtTokenIssuer;

                $builder = $builder->identifiedBy(uniqid('jti-'))
                    ->issuedBy($issuer)
                    ->canOnlyBeUsedAfter($now)
                    ->expiresAt($now->modify($expiresAtModifier));
            }

            return $builder->getToken(
                $jwt->getConfiguration()->signer(),
                $jwt->getConfiguration()->signingKey()
            );
        } catch (\Exception $e) {
            Yii::warning('JWT token generation failed: ' . $e->getMessage());
            return null;
        }
    }

    /**
     * Parse and validate a JWT token
     *
     * @param string $token
     * @return UnencryptedToken|null
     */
    public function parseToken(string $token): ?UnencryptedToken
    {
        if (!$this->enabled || !$this->isJwtComponentAvailable()) {
            return null;
        }

        try {
            /** @var \bizley\jwt\Jwt $jwt */
            $jwt = Yii::$app->get($this->jwtComponent);
            return $jwt->getParser()->parse($token);
        } catch (\Exception $e) {
            Yii::warning('JWT token parsing failed: ' . $e->getMessage());
            return null;
        }
    }

    /**
     * Extract user UUID from JWT token
     *
     * @param UnencryptedToken $token
     * @return string|null
     */
    public function getUserUuidFromToken(UnencryptedToken $token): ?string
    {
        $claims = $token->claims();
        return $claims->get('sub');
    }

    /**
     * Check if JWT component is available
     *
     * @return bool
     */
    protected function isJwtComponentAvailable(): bool
    {
        if (!$this->enabled) {
            Yii::info('JWT service is disabled.');
            return false;
        }

        if (!$this->jwtComponent || !Yii::$app->has($this->jwtComponent)) {
            Yii::warning('JWT component "' . $this->jwtComponent . '" is not configured.');
            return false;
        }

        return true;
    }
}
