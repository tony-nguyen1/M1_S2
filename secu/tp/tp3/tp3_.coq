(* Section Peano.

Parameter N : Set.
Parameter o : N.
Parameter s : N -> N.
Parameters plus mult : N -> N -> N.
Variables x y : N.

Axiom ax1 : ~((s x) = o).
Axiom ax2 : exists z, ~(x = o) -> (s z) = x.
Axiom ax3 : (s x) = (s y) -> x = y.
Axiom ax4 : (plus x o) = x.
Axiom ax5 : (plus x (s y)) = s (plus x y).
Axiom ax6 : (mult x o) = o.
Axiom ax7 : (mult x (s y)) = (plus (mult x y) x).

End Peano.

Hint Rewrite ax4 ax5 ax6 ax7 : peano_base. *)

Fixpoint plus (n m : nat) {struct n} : nat :=
  match n with
  | 0 => m
  | S n' => (S (plus n' m))
end.

Fixpoint mult (n m : nat) {struct n} : nat :=
  match n with
  | 0 => 0
  | S n' => plus (mult n' m) m (*on match n, le 1er arg, on le remet en 1er*)
  end.

Eval compute in (mult 2 3).

Lemma exo1_q1 : forall n : nat, mult 2 n = plus n n.
Proof.
  intro.
  
  simpl.
  reflexivity.
Qed.

Lemma le : forall x y : nat, (plus x (S y)) = S (plus x y).
Proof.
  intro.
  intro.
  induction x.
  - simpl. reflexivity.
  - simpl. rewrite IHx. reflexivity.
Qed.

Lemma lele : forall x : nat, (plus x 0) = x.
Proof.
  intro.
  induction x.
  - simpl. reflexivity.
  - simpl. rewrite IHx. reflexivity.
Qed.

Lemma exo1_q2 : forall n : nat, mult n 2 = plus n n.
Proof.
  intro.
  induction n.
  - simpl. reflexivity.
  - simpl. rewrite le. rewrite le. rewrite lele. rewrite le. rewrite IHn. reflexivity.
Qed.

Require Import List.

Fixpoint rev (n: list nat): list nat :=
  match n with
  | nil => nil
  | hd::tl => app (rev tl) (hd::nil)
end.

Lemma exo2_q1

