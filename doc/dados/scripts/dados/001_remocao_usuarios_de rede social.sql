
START TRANSACTION;

DELETE FROM `termos` WHERE `id` >= '369' AND `id` <= '375';

DELETE FROM `users` WHERE `id` >= '457' AND `id` <= '465';

COMMIT;

