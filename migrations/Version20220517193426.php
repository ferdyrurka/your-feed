<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220517193426 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE UNIQUE INDEX UNIQ_64C19C15E237E06 ON category (name)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_5A8A6C8D989D9B62 ON post (slug)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_5A8A6C8DF47645AE ON post (url)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_5A8A6C8D9F75D7B0 ON post (external_id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_5F8A7F735E237E06 ON source (name)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_5F8A7F73F47645AE ON source (url)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP INDEX UNIQ_64C19C15E237E06 ON category');
        $this->addSql('DROP INDEX UNIQ_5A8A6C8D989D9B62 ON post');
        $this->addSql('DROP INDEX UNIQ_5A8A6C8DF47645AE ON post');
        $this->addSql('DROP INDEX UNIQ_5A8A6C8D9F75D7B0 ON post');
        $this->addSql('DROP INDEX UNIQ_5F8A7F735E237E06 ON source');
        $this->addSql('DROP INDEX UNIQ_5F8A7F73F47645AE ON source');
    }
}
