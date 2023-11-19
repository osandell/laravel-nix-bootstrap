# OBS! Remember to stage flake.nix before running direnv allow or it will fail

{
  description = "A PHP 7.3 project";

  inputs = {
    nixpkgs.url = "github:NixOS/nixpkgs/695b3515251873e0a7e2021add4bba643c56cde3";

    # We use this repo since Nixpkgs avoids unmaintained software and thus don't have PHP
    # versions older than 8.1 at the moment. With fossar/nix-phps we get access to both
    # older and newer.
    phps.url = "github:fossar/nix-phps";
  };

  outputs = { self, nixpkgs, phps, }: {
    devShell.x86_64-darwin = with nixpkgs.legacyPackages.x86_64-darwin; mkShell {
      buildInputs = [
        # phps.packages.x86_64-darwin.php73  # Use the specific attribute name you found
        (phps.packages.x86_64-darwin.php73.buildEnv {
          extensions = ({ enabled, all }: enabled ++ (with all; [
            # Enable extensions here
          ]));
          extraConfig = ''
            # Add extra config here
          '';
        })
      ];
    };
  };
}
