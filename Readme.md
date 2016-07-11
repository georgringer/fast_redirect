# TYPO3 extension ``fast_redirect``

This extension provides currently a simple way to handle redirects for **not found pages**. Each redirect is saved in a record which can be created by any editor.

## How to use

### Installation

1) Install the extension as any extension
2) Define a fallback for errors in the *Extension Manager configuration*. This fallback is used for errors not covered by the extension.
3) Set the `pageNotFound_handling` to `USER_FUNCTION:typo3conf/ext/fast_redirect/Classes/Hooks/PageNotFoundHook.php:GeorgRinger\FastRedirect\Hooks\PageNotFoundHook->pageNotFound`

### Usage

Create a record **Redirect item** in the backend on any page and provide the URL you want to redirect and to which page it should be redirected.

## Additional information

### License

GPL 2.0

### Author

This extension is brought to you by Georg Ringer.