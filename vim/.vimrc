" Zoltan's vim config

" Color
filetype on
syntax on
colorscheme Tomorrow-Night

" Guifont
if has('gui_running')
  set guifont=Menlo\ Regular:h16
  set guioptions+=c "Stop opening dialogs
endif

" Default size
set lines=40 columns=90
" A colored column
set colorcolumn=90
" Show line numbers
set number

" The leader key
let mapleader=","
" Remap :
nnoremap ; :

" Mouse activated
set mouse=a
" Save file when focus lost
:au FocusLost * :wa

set tabstop=2
set noerrorbells
set nobackup
set noswapfile

" Reload vim configuration
map <leader>s :source ~/.vimrc<CR>

" Speed up vim
set hidden
set history=100

" Remove white spaces on save
autocmd BufWritePre * :%s/\s\+$//e

" Highlight search
set hlsearch
" Turn off highlight :noh
" Show the frist match while still typing
set incsearch


" switch between two files
nnoremap <Leader><Leader> :e#<CR>

" Show matching parenthesis
set showmatch

" Jumping between parenthesis, use %
" Use [{ for jumping back
" Use gd for local declaration.

" CTRL-N auto compleat.
" Record macro: qa -> record in register 'a', finish with type q again.
" Repeate macro: @a
