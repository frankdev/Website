---
title: "Lint, static code analysis and tests: First GitHub Actions Workflow"
slug: php-lint-workflow
description: In this lesson we will create a new Laravel Project.
created_at: "2023-12-30 00:01:00"
---

# Automate Lint, static code analysis and tests: First GitHub Actions Workflow

### The User Story: 
#### Automate Code Lint, Static Code Analysis and Tests
As a Developer I want to automatically run PHP Lint, Static Code Analyses and Test when I create 
a new Pull Request to the main branch, so we any error, bug or compatibility issue is caught before
my changes are merged into the main branch.

#### Acceptance Criteria:
- GitHub actions workflow is created
- Workflow runs when Pull Request to the main branch is created
- Pull Request can only be completed if the Workflows has no errors.


## Steps:

### 1. New Feature Branch
Before we dive into creating our GitHub Actions Workflow, let's starts by setting up a new feature branch four
our user story implementation.

1. Open your terminal:
   - Navigate to your project directory using the command line.
2. Create a new feature branch:
   -  To create a new branch for our user story, use the following command:
      ```bash
      git checkout -b feature/php-lint-workflow
      ```
       The command creates a new branch named ``feature/php-lint-workflow`` and switches to it.
3. Create the branch in GitHub.
   - To create this branch in our remote GitHub repository, use the following command:
     ```bash
      git push --set-upstream origin feature/php-lint-workflow
     ```
     Check the repository branches on GitHub. Visit the ``https://github.com/<username-organization>/<project-name>/branches``,
     you should see the recently created branches.

Now that we have our new feature branch we can start to implement our User Story.


### 2. Let's create the First GitHub Actions Workflow 
To enable GitHub Actions on our project, we need to create a new GitHub Actions Workflow. A Workflow
is a configurable-automated process that will run one or more jobs. Workflows are defined by a YAML file
checked in to our repository and will run when triggered by a pull request to the main branch.

Workflows are defined in the ``.github/workflows`` directory in a repository, we can have multiple workflows,
each of which can perform a different set of tasks. In this lesson we will create our first
```lint-analyse-test.yml``` workflow.


#### 1. Let's create ``link-analyse-test.yml`` workflow:
In your terminal, use the following commands:
```bash
# 1. Create the workflows directory: 
mkdir -p .github/workflows

# 2. Create the workflow file
touch .github/workflows/link-analyse-test.yml
```

#### 2. Let's Run a Hello Mundo! Action
Open the .github/workflows/link-analyse-test.yml in your IDE and add the following lines:
```yaml
# .github/workflows/link-analyse-test.yml
name: Lint, Analyse and Test
on:
  push:

jobs:
  Say-Hello:
    name: Say Hello Mundo!
    runs-on: ubuntu-latest
    steps:
      - run: echo "Hello Mundo!"

```

#### 3. Commit your changes and Push the feature branch:
Run the following command in your terminal:
```bash
git add .
git commit -am "Implement Hello Mundo! Action."
git push

```

#### 4. Check GitHub Actions Workflows Runs
Open your browser and navigate to ``https://github.com/<username-organization>/<project-name>/actions``,
you should be able to check that your new workflow as run.


<div class="w-full rounded-xl bg-gray-900 overflow-hidden">
<img src="/images/workflow-overview.png" class="object-cover not-prose w-full" alt="GitHub Actions Overview" />
</div>


If you click on "Implement Hello Mundo! Action" you will navigate to the workflow run details page and check
the job and actions status and details.

<div class="w-full rounded-xl bg-gray-900 overflow-hidden">
<img src="/images/implement-hello-mundo-action-run.png" class="object-cover not-prose" alt="GitHub Actions Overview" />
</div>

#### 5. Checkout and Setup PHP actions
Now that we successfully implemented our first action, we can move on and add more functionality 
to our pipeline.
We will need to checkout our code from the repository branch, and we will need to set up PHP on or
running environment, that in our case is the ubuntu-latest.


```yaml
# .github/workflows/link-analyse-test.yml
name: Lint, Analyse and Test
on:
  push:

jobs:
  Say-Hello:
    name: Say Hello Mundo!
    runs-on: ubuntu-latest
    steps:
      - run: echo "Hello Mundo!"
  Lint:
    name: PHP Lint
    run-on: ubuntu-latest
    steps:
      - run: echo "🎉 The job was automatically triggered by a ${{ github.event_name }} event."
        
      - uses: actions/checkout@v3
        name: Checkout branch
        
      - name: Setup PHP
        uses: shivammathur/setup-php@v2
        with:
            php-version: 8.2
            tools: laravel/pint, overtrue/phplint
      - name: Outupt PHP version 
        run: php --version

      - name: Check PHP syntax
        run: phplint --exclude=*.log .
        working-directory: service

      - name: Run Laravel Pint
        run: pint --test
        working-directory: service

```
