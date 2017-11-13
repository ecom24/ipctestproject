<?php

use Behat\Behat\Context\Context;
use Behat\MinkExtension\Context\MinkContext;
use Behat\Mink\Exception\ExpectationException;

class FeatureContext extends MinkContext implements Context
{
    /**
     * @var array
     */
    private $filters;

    /**
     * FeatureContext constructor
     */
    public function __construct()
    {
        $this->filters = [];
    }

    /**
     * @return mixed
     * @throws \Behat\Mink\Exception\DriverException
     * @throws \Behat\Mink\Exception\UnsupportedDriverActionException
     */
    protected function getResponseContent()
    {
        $responseContent = $this->getSession()->getDriver()->getContent();

        return json_decode($responseContent);
    }

    /**
     * @param string $url
     * @param $postData
     */
    protected function postRequest(string $url, $postData)
    {
        $this->getSession()->getDriver()->getClient()->request('POST', $url, $postData);
    }

    /**
     * @Given I am an API consumer
     */
    public function i_am_an_api_consumer()
    {
        /**
         * Return true for the proof of concept only.
         * Production development would include api authorization.
         */
        return true;
    }

    /**
     * @Given I filter by :key :value
     */
    public function i_filter_by(string $key, $value)
    {
        $this->filters[$key] = $value;
    }

    /**
     * @Given I fetch the results from the /books resource
     */
    public function i_fetch_the_results_from_the_books_resource()
    {
        $filter = [
            'filter' => $this->filters
        ];

        $url = route('api.books.get', $filter);

        $this->visit($url);
    }

    /**
     * @Given I fetch the results from the \/books\/categories resource
     */
    public function i_fetch_the_results_from_the_books_categories_resource()
    {
        $url = route('api.books.categories.get');

        $this->visit($url);
    }

    /**
     * @Then I should receive a :status response
     */
    public function i_should_receive_a_response($status)
    {
        $this->assertResponseStatus($status);
    }

    /**
     * @Then The body should contain :resultCount results
     */
    public function the_body_should_contain_results($resultCount)
    {
        $response = $this->getResponseContent();

        $countResponse = count($response);

        if (count($response) != $resultCount) {
            throw new ExpectationException("Wrong result count ({$countResponse})", $this->getSession()->getDriver());
        }
    }

    /**
     * @Then The body should contain :value
     */
    public function the_body_should_contain($value)
    {
        $this->assertResponseContains($value);
    }

    /**
     * @Given I fetch all categories
     */
    public function i_fetch_all_categories()
    {
        $url = route('api.books.categories.get');

        $this->visit($url);
    }

    /**
     * @Given I create a valid book by posting to the \/books resource
     */
    public function i_create_a_valid_book_by_posting_to_the_books_resource()
    {
        $postData = [
            'isbn' => '978-1491905012',
            'title' => 'Modern PHP: New Features and Good Practices',
            'author' => 'Josh Lockhart',
            'category' => 'PHP',
            'price' => '18.99 GBP'
        ];

        $url = route('api.books.create.post');

        $this->postRequest($url, $postData);
    }

    /**
     * @Given I create the invalid book by posting to the \/books resource
     */
    public function i_create_an_invalid_book_by_posting_to_the_books_resource()
    {
        $postData = [
            'isbn' => '978-INVALID-ISBN-1491905012',
            'title' => 'Modern PHP: New Features and Good Practices',
            'author' => 'Josh Lockhart',
            'category' => 'PHP',
            'price' => '18.99 GBP'
        ];

        $url = route('api.books.create.post');

        $this->postRequest($url, $postData);
    }

}
