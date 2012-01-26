<?php

// include the micro framework limonade
require_once(implode(DIRECTORY_SEPARATOR, array(dirname(__FILE__), '..', 'lib', 'limonade.php')));

// setup routes to listen to urls
dispatch('/', 'indexPage');
dispatch('/posts', 'postsPage');
dispatch('/about', 'aboutPage');

// setup the index (home) page
function indexPage()
{
	// setup the header and navigation list
	$output = '<h1>Home Page</h1>';
	$output .= navigationList();

	// home page content
	$output .= '<p>This is the home page.</p>';

	// return the page output
	return $output;
}

// setup the page to list posts
function postsPage()
{
	// get the posts
	$posts = getPosts();

	// setup the header and navigation list
	$output = '<h1>Posts</h1>';
	$output .= navigationList();

	// build a list of page posts
	foreach($posts as $post)
	{
		// each post has a $post['name'] and a $post['body']
		// the $post['body'] is valid HTML
		$output .= '<h2 class=""postName>' . $post['name'] . '</h2>';
		$output .= '<div class="postBody">' . $post['body'] . '</div>';
	}

	// return the page output
	return $output;
}

// setup the about page
function aboutPage()
{
	// setup the header and navigation list
	$output = '<h1>About</h1>';
	$output .= navigationList();

	// about page content
	$output .= '<p>This is a page that would tell you about us.</p>';

	// return the page output
	return $output;
}

// build a central navigation list
function navigationList()
{
	$output = '<ul>';
	$output .= '<li><a href="' . url_for('') . '">Home</a></li>';
	$output .= '<li><a href="' . url_for('Posts') . '">Posts</a></li>';
	$output .= '<li><a href="' . url_for('about') . '">About</a></li>';
	$output .= '</ul>';
	return $output;
}

// get posts, up to ten maximum
// each post has a $post['name'] and a $post['body']
function getPosts()
{
	// get all posts
	$posts = _postDatabase();

	// return all the posts
	return $posts;
}

// mimic a database select call for posts
function _postDatabase()
{
	// store the posts
	$posts = array();
	
	// pretend there are 100 posts in the database
	for($i = 1; $i <= 100; $i++)
	{
		// add one to the end of the posts array
		$posts[] = array(
			'name' => 'Post Number ' . $i,
			'body' => '<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur.</p><p>Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>'
		);
	}

	// return posts
	return $posts;
}


// hand the page off to the limonade dispatcher to render
run();
