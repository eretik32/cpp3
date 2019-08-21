<?php declare(strict_types=1);

namespace Application\Migrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190813131246 extends AbstractMigration
{
    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('DROP TABLE super_image');
        $this->addSql('ALTER TABLE image DROP INDEX UNIQ_C53D045F57EB50C2, ADD INDEX IDX_C53D045F57EB50C2 (research)');
        $this->addSql('ALTER TABLE research DROP FOREIGN KEY FK_57EB50C22B36786B');
        $this->addSql('DROP INDEX UNIQ_57EB50C22B36786B ON research');
        $this->addSql('ALTER TABLE research DROP title');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE super_image (id INT AUTO_INCREMENT NOT NULL, picture_url VARCHAR(255) NOT NULL COLLATE utf8_unicode_ci, size INT NOT NULL, length INT NOT NULL, width INT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE image DROP INDEX IDX_C53D045F57EB50C2, ADD UNIQUE INDEX UNIQ_C53D045F57EB50C2 (research)');
        $this->addSql('ALTER TABLE research ADD title INT DEFAULT NULL');
        $this->addSql('ALTER TABLE research ADD CONSTRAINT FK_57EB50C22B36786B FOREIGN KEY (title) REFERENCES image (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_57EB50C22B36786B ON research (title)');
    }
}
