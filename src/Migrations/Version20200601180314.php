<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200601180314 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE artwork_discussion_theme (artwork_id INT NOT NULL, discussion_theme_id INT NOT NULL, INDEX IDX_9AB17BECDB8FFA4 (artwork_id), INDEX IDX_9AB17BECEC5AE590 (discussion_theme_id), PRIMARY KEY(artwork_id, discussion_theme_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE artwork_discussion_theme ADD CONSTRAINT FK_9AB17BECDB8FFA4 FOREIGN KEY (artwork_id) REFERENCES artwork (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE artwork_discussion_theme ADD CONSTRAINT FK_9AB17BECEC5AE590 FOREIGN KEY (discussion_theme_id) REFERENCES discussion_theme (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE discussion_theme DROP FOREIGN KEY FK_58EA1C3DDB8FFA4');
        $this->addSql('DROP INDEX IDX_58EA1C3DDB8FFA4 ON discussion_theme');
        $this->addSql('ALTER TABLE discussion_theme DROP artwork_id');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('DROP TABLE artwork_discussion_theme');
        $this->addSql('ALTER TABLE discussion_theme ADD artwork_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE discussion_theme ADD CONSTRAINT FK_58EA1C3DDB8FFA4 FOREIGN KEY (artwork_id) REFERENCES artwork (id)');
        $this->addSql('CREATE INDEX IDX_58EA1C3DDB8FFA4 ON discussion_theme (artwork_id)');
    }
}
