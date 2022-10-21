<?php

declare(strict_types=1);

namespace Notebook\Note\Infrastructure\BehatContext;

use Behat\Behat\Context\Context;
use Notebook\Common\Application\Service\IdGenerator\IdGeneratorServiceInterface;
use Notebook\Common\Domain\Id\Id;
use Notebook\Common\Infrastructure\Test\TestHelper\TestHelperServiceInterface;
use Notebook\Note\Application\Projection\Note\NoteFilter;
use Notebook\Note\Application\Service\Note\NoteServiceInterface;
use Notebook\Note\Domain\Note\Note;
use Webmozart\Assert\Assert;

final class NoteContext implements Context
{
    private TestHelperServiceInterface $testHelper;
    private NoteServiceInterface $noteService;
    private IdGeneratorServiceInterface $idGenerator;

    public function __construct(
        TestHelperServiceInterface $testHelper,
        NoteServiceInterface $noteService,
        IdGeneratorServiceInterface $idGenerator
    ) {
        $this->testHelper = $testHelper;
        $this->noteService = $noteService;
        $this->idGenerator = $idGenerator;
    }

    /**
     * @Given there are no notes
     */
    public function thereAreNoNotes(): void
    {
        $this->testHelper->truncateTable(Note::class);
    }

    /**
     * @Given there is a note with name :name and content :content
     *
     * @When I create a note with name :name and content :content
     */
    public function iCreateANoteWithNameAndContent(
        string $name,
        string $content,
    ): void {
        $this->noteService->create(
            $this->idGenerator->create(),
            $name,
            $content
        );
    }

    /**
     * @Then there should be a stored note with the content :content for the name :name
     */
    public function thereShouldBeAStoredNoteWithTheContentForTheName(
        string $content,
        string $name,
    ): void {
        $noteDto = $this->noteService->findOne(
            NoteFilter::create()
                    ->setName($name)
        );

        Assert::notNull($noteDto);
        Assert::eq($content, $noteDto->getContent());
        Assert::eq($name, $noteDto->getName());
    }

    /**
     * @When I edit a note :name with new content :content
     */
    public function iEditANoteWithNewContent(
        string $content,
        string $name,
    ): void {
        $noteDto = $this->noteService->findOne(
            NoteFilter::create()
                ->setName($name)
        );

        Assert::notNull($noteDto);

        $this->noteService->update(
            new Id(
                $noteDto->getId()
            ),
            $content
        );
    }
}
