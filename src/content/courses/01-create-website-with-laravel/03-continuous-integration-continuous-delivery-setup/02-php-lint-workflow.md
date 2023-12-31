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

### New Feature Branch


### Let's create the First GitHub Actions Workflow 
To enable GitHub Actions on our project, we need to create a new GitHub Actions Workflow. A Workflow
is a configurable-automated process that will run one or more jobs. Workflows are defined by a YAML file
checked in to our repository and will run when triggered by a pull request to the main branch.

Workflows are defined in the ``.github/workflows`` directory in a repository, we can have multiple workflows,
each of which can perform a different set of tasks. In this lesson we will create our first
```lint-analyse-test.yml``` workflow.


This file needs to be on a special folder named ``workflows`` inside of the 
``.github`` folder. 


```bash
# 1. On create the following folder: 
$ mkdir -p .github/workflows

#

```
