/* eslint quote-props: "error" */
module.exports = {
  'extends': [
		'plugin:@wordpress/eslint-plugin/recommended',
    'plugin:@typescript-eslint/recommended',
    'plugin:import/errors',
    'plugin:import/warnings',
  ],
  'settings': {
    'import/resolver': {
      'alias': {
        'map': [
          ['src', './src'],
        ],
        'extensions': ['.js', '.jsx', '.ts', '.tsx'],
      },
      'node': {
        'extensions': ['.js', '.jsx', '.ts', '.tsx'],
      },
      'typescript': {},
    },
    // Tell eslint-plugin-react which version of React is in use. Current as of WordPress 5.4 Beta 2.
    'react': {
      'version': '16.9.0',
    },
  },
  'parser': '@typescript-eslint/parser',
  'parserOptions': {
    'ecmaVersion': 9,
    'sourceType': 'module',
    'ecmaFeatures': {
      'jsx': true,
      'impliedStrict': true,
    },
  },
  'env': {
    'browser': true,
    'node': true,
    'es6': true,
    'jest': true,
  },
  'rules': {
    '@typescript-eslint/indent': ['warn', 2],
    '@typescript-eslint/quotes': ['error', 'single'],
    '@typescript-eslint/ban-ts-ignore': ['off'], // Necesary due to weaknesses of WP types.
    'react/jsx-props-no-spreading': 'off',
    'import/no-named-as-default': 'off',
    'jsx-a11y/interactive-supports-focus': 'warn',
    'jsx-a11y/label-has-associated-control': [
      'error',
      {
        'controlComponents': [
          'Group',
        ],
      },
    ],
    'jsx-a11y/label-has-for': ['warn', {
      'required': {
        'every': ['id'],
      },
    }],
		'react/jsx-filename-extension': [ 'error', { 'extensions': [ '.tsx' ] } ],
    'react/react-in-jsx-scope': ['error'],
    'max-len': [ 'error', {
			'ignoreTemplateLiterals': true,
			'ignoreStrings': true,
			'ignoreComments': true,
			'code': 200,
		} ],
		'react-hooks/rules-of-hooks': 'error',
    'react-hooks/exhaustive-deps': 'warn',
  },
  'plugins': [
		'react',
		'react-hooks',
    '@typescript-eslint',
  ],
};
