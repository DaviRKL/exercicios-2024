<?php

namespace Chuva\Php\WebScrapping\Entity;

/**
 * The Paper class represents the row of the parsed data.
 */
class Paper {
  /**
   * Paper Id.
   *
   * @var int
   */
  public $id;

  /**
   * Paper Title.
   *
   * @var string
   */
  public $title;

  /**
   * The paper type (e.g. Poster, Nobel Prize, etc).
   *
   * @var string
   */
  public $type;

  /**
   * Paper authors.
   *
   * @var \Chuva\Php\WebScrapping\Entity\Person[]
   */
  public $authors;

  /**
   * Constructor.
   *
   * @param int $id
   *   The ID of the paper.
   * @param string $title
   *   The title of the paper.
   * @param string $type
   *   The type of the paper.
   * @param array $authors
   *   The authors of the paper.
   */
  public function __construct($id, $title, $type, $authors = []) {
    $this->id = $id;
    $this->title = $title;
    $this->type = $type;
    $this->authors = $authors;
  }

  /**
   * Get the ID of the paper.
   *
   * @return int
   *   The ID of the paper.
   */
  public function getId() {
    return $this->id;
  }

  /**
   * Get the title of the paper.
   *
   * @return string
   *   The title of the paper.
   */
  public function getTitle() {
    return $this->title;
  }

  /**
   * Get the type of the paper.
   *
   * @return string
   *   The type of the paper.
   */
  public function getType() {
    return $this->type;
  }

  /**
   * Get the authors of the paper.
   *
   * @return \Chuva\Php\WebScrapping\Entity\Person[]
   *   The authors of the paper.
   */
  public function getAuthors() {
    return $this->authors;
  }

}
