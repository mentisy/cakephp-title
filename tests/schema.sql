CREATE TABLE `files_types`
(
    `id`      INT          NULL,
    `name` VARCHAR(255) NULL DEFAULT NULL,
    `title` VARCHAR(255) NULL DEFAULT NULL,
    PRIMARY KEY (`id`)
);

CREATE TABLE `locations`
(
    `id`      INT          NULL,
    `name` VARCHAR(255) NULL DEFAULT NULL,
    `city` VARCHAR(255) NULL DEFAULT NULL,
    PRIMARY KEY (`id`)
);

CREATE TABLE `monitoring`
(
    `id`      INT          NULL,
    `title` VARCHAR(255) NULL DEFAULT NULL,
    PRIMARY KEY (`id`)
);
