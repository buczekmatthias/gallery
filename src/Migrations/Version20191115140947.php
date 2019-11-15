<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20191115140947 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'sqlite', 'Migration can only be executed safely on \'sqlite\'.');

        $this->addSql('DROP INDEX IDX_B78FCCA0A21214B7');
        $this->addSql('DROP INDEX IDX_B78FCCA08D7B4FB4');
        $this->addSql('CREATE TEMPORARY TABLE __temp__categories_tags AS SELECT categories_id, tags_id FROM categories_tags');
        $this->addSql('DROP TABLE categories_tags');
        $this->addSql('CREATE TABLE categories_tags (categories_id INTEGER NOT NULL, tags_id INTEGER NOT NULL, PRIMARY KEY(categories_id, tags_id), CONSTRAINT FK_B78FCCA0A21214B7 FOREIGN KEY (categories_id) REFERENCES categories (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE, CONSTRAINT FK_B78FCCA08D7B4FB4 FOREIGN KEY (tags_id) REFERENCES tags (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE)');
        $this->addSql('INSERT INTO categories_tags (categories_id, tags_id) SELECT categories_id, tags_id FROM __temp__categories_tags');
        $this->addSql('DROP TABLE __temp__categories_tags');
        $this->addSql('CREATE INDEX IDX_B78FCCA0A21214B7 ON categories_tags (categories_id)');
        $this->addSql('CREATE INDEX IDX_B78FCCA08D7B4FB4 ON categories_tags (tags_id)');
        $this->addSql('DROP INDEX IDX_472B783A12469DE2');
        $this->addSql('CREATE TEMPORARY TABLE __temp__gallery AS SELECT id, category_id, image, title, added_at FROM gallery');
        $this->addSql('DROP TABLE gallery');
        $this->addSql('CREATE TABLE gallery (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, category_id INTEGER NOT NULL, image BLOB NOT NULL, title VARCHAR(300) DEFAULT NULL COLLATE BINARY, added_at DATETIME DEFAULT NULL, CONSTRAINT FK_472B783A12469DE2 FOREIGN KEY (category_id) REFERENCES categories (id) NOT DEFERRABLE INITIALLY IMMEDIATE)');
        $this->addSql('INSERT INTO gallery (id, category_id, image, title, added_at) SELECT id, category_id, image, title, added_at FROM __temp__gallery');
        $this->addSql('DROP TABLE __temp__gallery');
        $this->addSql('CREATE INDEX IDX_472B783A12469DE2 ON gallery (category_id)');
        $this->addSql('DROP INDEX IDX_43D9330EA76ED395');
        $this->addSql('DROP INDEX IDX_43D9330E4E7AF8F');
        $this->addSql('CREATE TEMPORARY TABLE __temp__user_gallery_likes AS SELECT gallery_id, user_id FROM user_gallery_likes');
        $this->addSql('DROP TABLE user_gallery_likes');
        $this->addSql('CREATE TABLE user_gallery_likes (gallery_id INTEGER NOT NULL, user_id INTEGER NOT NULL, PRIMARY KEY(gallery_id, user_id), CONSTRAINT FK_43D9330E4E7AF8F FOREIGN KEY (gallery_id) REFERENCES gallery (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE, CONSTRAINT FK_43D9330EA76ED395 FOREIGN KEY (user_id) REFERENCES user (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE)');
        $this->addSql('INSERT INTO user_gallery_likes (gallery_id, user_id) SELECT gallery_id, user_id FROM __temp__user_gallery_likes');
        $this->addSql('DROP TABLE __temp__user_gallery_likes');
        $this->addSql('CREATE INDEX IDX_43D9330EA76ED395 ON user_gallery_likes (user_id)');
        $this->addSql('CREATE INDEX IDX_43D9330E4E7AF8F ON user_gallery_likes (gallery_id)');
        $this->addSql('DROP INDEX IDX_70232B914E7AF8F');
        $this->addSql('DROP INDEX IDX_70232B91A76ED395');
        $this->addSql('CREATE TEMPORARY TABLE __temp__user_gallery_saves AS SELECT gallery_id, user_id FROM user_gallery_saves');
        $this->addSql('DROP TABLE user_gallery_saves');
        $this->addSql('CREATE TABLE user_gallery_saves (gallery_id INTEGER NOT NULL, user_id INTEGER NOT NULL, PRIMARY KEY(gallery_id, user_id), CONSTRAINT FK_70232B914E7AF8F FOREIGN KEY (gallery_id) REFERENCES gallery (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE, CONSTRAINT FK_70232B91A76ED395 FOREIGN KEY (user_id) REFERENCES user (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE)');
        $this->addSql('INSERT INTO user_gallery_saves (gallery_id, user_id) SELECT gallery_id, user_id FROM __temp__user_gallery_saves');
        $this->addSql('DROP TABLE __temp__user_gallery_saves');
        $this->addSql('CREATE INDEX IDX_70232B914E7AF8F ON user_gallery_saves (gallery_id)');
        $this->addSql('CREATE INDEX IDX_70232B91A76ED395 ON user_gallery_saves (user_id)');
        $this->addSql('DROP INDEX IDX_1BE3E1F4A76ED395');
        $this->addSql('DROP INDEX IDX_1BE3E1F44E7AF8F');
        $this->addSql('CREATE TEMPORARY TABLE __temp__user_gallery_views AS SELECT gallery_id, user_id FROM user_gallery_views');
        $this->addSql('DROP TABLE user_gallery_views');
        $this->addSql('CREATE TABLE user_gallery_views (gallery_id INTEGER NOT NULL, user_id INTEGER NOT NULL, PRIMARY KEY(gallery_id, user_id), CONSTRAINT FK_1BE3E1F44E7AF8F FOREIGN KEY (gallery_id) REFERENCES gallery (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE, CONSTRAINT FK_1BE3E1F4A76ED395 FOREIGN KEY (user_id) REFERENCES user (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE)');
        $this->addSql('INSERT INTO user_gallery_views (gallery_id, user_id) SELECT gallery_id, user_id FROM __temp__user_gallery_views');
        $this->addSql('DROP TABLE __temp__user_gallery_views');
        $this->addSql('CREATE INDEX IDX_1BE3E1F4A76ED395 ON user_gallery_views (user_id)');
        $this->addSql('CREATE INDEX IDX_1BE3E1F44E7AF8F ON user_gallery_views (gallery_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'sqlite', 'Migration can only be executed safely on \'sqlite\'.');

        $this->addSql('DROP INDEX IDX_B78FCCA0A21214B7');
        $this->addSql('DROP INDEX IDX_B78FCCA08D7B4FB4');
        $this->addSql('CREATE TEMPORARY TABLE __temp__categories_tags AS SELECT categories_id, tags_id FROM categories_tags');
        $this->addSql('DROP TABLE categories_tags');
        $this->addSql('CREATE TABLE categories_tags (categories_id INTEGER NOT NULL, tags_id INTEGER NOT NULL, PRIMARY KEY(categories_id, tags_id))');
        $this->addSql('INSERT INTO categories_tags (categories_id, tags_id) SELECT categories_id, tags_id FROM __temp__categories_tags');
        $this->addSql('DROP TABLE __temp__categories_tags');
        $this->addSql('CREATE INDEX IDX_B78FCCA0A21214B7 ON categories_tags (categories_id)');
        $this->addSql('CREATE INDEX IDX_B78FCCA08D7B4FB4 ON categories_tags (tags_id)');
        $this->addSql('DROP INDEX IDX_472B783A12469DE2');
        $this->addSql('CREATE TEMPORARY TABLE __temp__gallery AS SELECT id, category_id, image, title, added_at FROM gallery');
        $this->addSql('DROP TABLE gallery');
        $this->addSql('CREATE TABLE gallery (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, category_id INTEGER NOT NULL, image BLOB NOT NULL, title VARCHAR(300) DEFAULT NULL, added_at DATETIME DEFAULT NULL)');
        $this->addSql('INSERT INTO gallery (id, category_id, image, title, added_at) SELECT id, category_id, image, title, added_at FROM __temp__gallery');
        $this->addSql('DROP TABLE __temp__gallery');
        $this->addSql('CREATE INDEX IDX_472B783A12469DE2 ON gallery (category_id)');
        $this->addSql('DROP INDEX IDX_43D9330E4E7AF8F');
        $this->addSql('DROP INDEX IDX_43D9330EA76ED395');
        $this->addSql('CREATE TEMPORARY TABLE __temp__user_gallery_likes AS SELECT gallery_id, user_id FROM user_gallery_likes');
        $this->addSql('DROP TABLE user_gallery_likes');
        $this->addSql('CREATE TABLE user_gallery_likes (gallery_id INTEGER NOT NULL, user_id INTEGER NOT NULL, PRIMARY KEY(gallery_id, user_id))');
        $this->addSql('INSERT INTO user_gallery_likes (gallery_id, user_id) SELECT gallery_id, user_id FROM __temp__user_gallery_likes');
        $this->addSql('DROP TABLE __temp__user_gallery_likes');
        $this->addSql('CREATE INDEX IDX_43D9330E4E7AF8F ON user_gallery_likes (gallery_id)');
        $this->addSql('CREATE INDEX IDX_43D9330EA76ED395 ON user_gallery_likes (user_id)');
        $this->addSql('DROP INDEX IDX_70232B914E7AF8F');
        $this->addSql('DROP INDEX IDX_70232B91A76ED395');
        $this->addSql('CREATE TEMPORARY TABLE __temp__user_gallery_saves AS SELECT gallery_id, user_id FROM user_gallery_saves');
        $this->addSql('DROP TABLE user_gallery_saves');
        $this->addSql('CREATE TABLE user_gallery_saves (gallery_id INTEGER NOT NULL, user_id INTEGER NOT NULL, PRIMARY KEY(gallery_id, user_id))');
        $this->addSql('INSERT INTO user_gallery_saves (gallery_id, user_id) SELECT gallery_id, user_id FROM __temp__user_gallery_saves');
        $this->addSql('DROP TABLE __temp__user_gallery_saves');
        $this->addSql('CREATE INDEX IDX_70232B914E7AF8F ON user_gallery_saves (gallery_id)');
        $this->addSql('CREATE INDEX IDX_70232B91A76ED395 ON user_gallery_saves (user_id)');
        $this->addSql('DROP INDEX IDX_1BE3E1F44E7AF8F');
        $this->addSql('DROP INDEX IDX_1BE3E1F4A76ED395');
        $this->addSql('CREATE TEMPORARY TABLE __temp__user_gallery_views AS SELECT gallery_id, user_id FROM user_gallery_views');
        $this->addSql('DROP TABLE user_gallery_views');
        $this->addSql('CREATE TABLE user_gallery_views (gallery_id INTEGER NOT NULL, user_id INTEGER NOT NULL, PRIMARY KEY(gallery_id, user_id))');
        $this->addSql('INSERT INTO user_gallery_views (gallery_id, user_id) SELECT gallery_id, user_id FROM __temp__user_gallery_views');
        $this->addSql('DROP TABLE __temp__user_gallery_views');
        $this->addSql('CREATE INDEX IDX_1BE3E1F44E7AF8F ON user_gallery_views (gallery_id)');
        $this->addSql('CREATE INDEX IDX_1BE3E1F4A76ED395 ON user_gallery_views (user_id)');
    }
}