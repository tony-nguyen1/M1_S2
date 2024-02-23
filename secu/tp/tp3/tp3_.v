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
(* Ça met le 1er élèm à la fin (hd), puis récursion *)
  match n with
  | nil => nil
  | hd::tl => app (rev tl) (hd::nil) (* concatenation de 2 listes*)
end.

Lemma exo2_q1 : forall (l : list nat) (e : nat), 
rev (app l (e::nil)) = e :: rev l.
Proof.
  intro l.
  intro e.
  induction l as [| hd tl IHl].
  - simpl. reflexivity.
  - simpl. rewrite IHl. reflexivity.
Qed.

Lemma exo2_q2 : forall (l : list nat), rev(rev(l)) = l.
Proof.
  intro l.
  induction l as [| hd tail IHl].
  - simpl. reflexivity.
  - simpl. rewrite exo2_q1. rewrite IHl. reflexivity.
Qed.

