<?php
#[Attribute(Attribute::TARGET_PROPERTY)]
final class Required {}

#[Attribute(Attribute::TARGET_PROPERTY)]
final class MinLength {
    public function __construct(public int $n) {}
}

final class RegisterUserDto {
    #[Required]
    public string $email;

    #[Required]
    #[MinLength(6)]
    public string $password;

    #[Required]
    #[MinLength(2)]
    public string $name;

    public function __construct(string $email, string $password, string $name) {
        $this->email = $email;
        $this->password = $password;
        $this->name = $name;
    }
}

final class AttributeValidator {
    public function validate(object $dto): array {
        $errors = [];

        $rc = new ReflectionClass($dto);
        foreach ($rc->getProperties() as $prop) {
            $name = $prop->getName();
            $value = $prop->getValue($dto);

            $required = $prop->getAttributes(Required::class);
            if (count($required) > 0) {
                if (!is_string($value) || trim($value) === '') {
                    $errors[] = $name . ' is required';
                    continue;
                }
            }

            $minAttrs = $prop->getAttributes(MinLength::class);
            if (count($minAttrs) > 0) {
                $min = $minAttrs[0]->newInstance()->n;
                if (is_string($value) && mb_strlen(trim($value), 'UTF-8') < $min) {
                    $errors[] = $name . ' too short';
                }
            }
        }

        return $errors;
    }
}
