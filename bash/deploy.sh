# Get commit msg from arguments
commitmsg=$1;

# SSH into tinybird dev server then:
#   echo commit msg to temp file
#   commit and push
#   remove temp file
ssh tinybird.ca "
  cd sic;
  echo $commitmsg > commitmsg;
  ls;
  git add -A;
  git status;
  git commit -F commitmsg;
";

# SSH into SIC site then:
#   Go to theme root
#   Remove all files
# ssh southislandchild.ca '
#   cd www/wp-content/themes;
#   rm -r blankslate-child;
#   git clone https://github.com/colinmcparland/southislandchild.git blankslate-child;
#   chmod -R 755 blankslate-child;
#   ls blankslate-child;
#   exit;
# ';