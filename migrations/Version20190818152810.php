<?php declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190818152810 extends AbstractMigration
{

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf(
            $this->connection->getDatabasePlatform()->getName() !== 'postgresql',
            'Migration can only be executed safely on \'postgresql\'.'
        );

        $this->addSql('CREATE TABLE author (
            id UUID NOT NULL,
            name VARCHAR(255) NOT NULL,
            PRIMARY KEY(id)
        )');
        $this->addSql('COMMENT ON COLUMN author.id IS \'(DC2Type:uuid)\'');

        $this->addSql('ALTER TABLE book
            ADD author_id UUID DEFAULT NULL');
        $this->addSql('COMMENT ON COLUMN book.author_id IS \'(DC2Type:uuid)\'');

        $this->addSql('ALTER TABLE book
            ADD CONSTRAINT FK_CBE5A331F675F31B FOREIGN KEY (author_id)
                REFERENCES author (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('CREATE INDEX IDX_CBE5A331F675F31B ON book (author_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf(
            $this->connection->getDatabasePlatform()->getName() !== 'postgresql',
            'Migration can only be executed safely on \'postgresql\'.'
        );

        $this->addSql('ALTER TABLE book DROP CONSTRAINT FK_CBE5A331F675F31B');
        $this->addSql('DROP TABLE author');
        $this->addSql('DROP INDEX IDX_CBE5A331F675F31B');
        $this->addSql('ALTER TABLE book DROP author_id');
    }
}
